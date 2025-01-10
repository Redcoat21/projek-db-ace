ROBAH => SINGAPORE
VIERY => INDONESIA
KENNETH => AMERICA
DAHREN => CHINA
1. BUAT DB DENGAN NAMA ACEHARD dan password proyekdd
2. BUAT LISTNER KE BERBAGAI DB
- con_robah (192.168.1.201)
- con_kenneth (192.168.1.202)
- con_viery (192.168.1.203)
- con_dahren (192.168.1.204)
3. BUAT DBLINK:
CREATE DATABASE LINK TO_ROBAH 
CONNECT TO system IDENTIFIED BY proyekdd 
USING 'con_robah';
CREATE DATABASE LINK TO_KENNETH 
CONNECT TO system IDENTIFIED BY proyekdd 
USING 'con_kenneth';
CREATE DATABASE LINK TO_VIERY 
CONNECT TO system IDENTIFIED BY proyekdd 
USING 'con_viery';
CREATE DATABASE LINK TO_DAHREN 
CONNECT TO system IDENTIFIED BY proyekdd 
USING 'con_dahren';
2. JALANKAN BERIKUT
create table variable(
    varname varchar2(255),
    varvalue varchar2(255)
);
CREATE TABLE branch (
    Branch_name VARCHAR2(200 BYTE) NOT NULL,
    dblink varchar2(200 byte) not null,
    "Address" VARCHAR2(200 BYTE) NOT NULL
);
create table product(
    Product_id varchar2 (255 byte) primary key,
    "Name" varchar2 (50 byte) not null,
    "Type" varchar2 (50 byte) not null,
    Price number (15) not null,
    Stok number (15) not null,
    Branch_Owner varchar2 (20 byte) not null,
    dblink varchar2(200 byte)
);

create table productDummy(
    Product_id varchar2 (255 byte),
    "Name" varchar2 (50 byte) not null,
    "Type" varchar2 (50 byte) not null,
    Price number (15) not null,
    Stok number (15) not null,
    Branch_Owner varchar2 (20 byte) not null,
    dblink varchar2(200 byte),
    statuss varchar2(255)
);

create table productFromAllBranch(
    Product_id varchar2 (255 byte),
    "Name" varchar2 (50 byte) not null,
    "Type" varchar2 (50 byte) not null,
    Price number (15) not null,
    Stok number (15) not null,
    Branch_Owner varchar2 (20 byte) not null,
    dblink varchar2(200 byte)
);

create table customerFromAllBranch(
    Customer_id varchar2 (12 byte),
    "Name" varchar2(100 byte) not null,
    Contact varchar2(100 byte) not null,
    "Address" varchar2(200 byte) not null
);

create table employee(
    Employee_id varchar2 (12 byte) primary key,
    username varchar2(255 byte) unique,
    passwordd varchar2(255 byte),
    "Name" varchar2 (100 byte) not null,
    "Address" varchar2 (200 byte) not null,
    "Contact" varchar2 (100 byte) not null,
    Age number (10) not null,
    Salary number (15) not null,
    Position varchar2 (200 byte) not null,
    HireDate date not null,
    is_deleted number default 0
);

create table customer(
    Customer_id varchar2 (12 byte) primary key,
    "Name" varchar2(100 byte) not null,
    Contact varchar2(100 byte) not null unique,
    "Address" varchar2(200 byte) not null
);

create table htrans(
    -- Branch_id varchar2 (12 byte),
    Htrans_id varchar2 (12 byte) primary key,
    Transaction_date date not null,
    Employee_id varchar2 (255 byte),
    Customer_id varchar2 (255 byte),
    Total varchar2 (15 byte) not null,
    foreign key (Employee_id) references employee(Employee_id),
    foreign key (Customer_id) references customer(Customer_id)
    -- foreign key (Branch_id) references branch(Branch_id),
);

create table dtrans(
    Dtrans_id varchar2 (12 byte) primary key,
    Htrans_id varchar2 (12 byte),
    Product_id varchar2 (255 byte),
    Quantity number (15),
    Subtotal number (15),
    foreign key (Htrans_id) references htrans(Htrans_id),
    foreign key (Product_id) references product(Product_id)
);

create table InterBranchTransaction(
    IBT_id varchar2 (12 byte) primary key,
    branch_buyer varchar2(255) not null,
    Product_id varchar2 (255),
    Quantity number (15) not null,
    total number (15) not null,
    dates date not null,
    foreign key (Product_id) references product(Product_id)
);
create table ProductTransaction(
    Product_id varchar2 (255),
    Quantity number (15),
    Employee_id varchar2 (15),
    foreign key (Product_id) references product(Product_id)
);
create sequence sequencecustomerProject
    minvalue 1
    maxvalue 1000
    start with 1
    increment by 1
    cache 20;

create sequence sequenceEmployee
    minvalue 1
    maxvalue 1000
    start with 1
    increment by 1
    cache 20;

create sequence HTRANSSEQUENCE
    minvalue 1
    maxvalue 1000
    start with 1
    increment by 1
    cache 20;

create sequence DTRANSSEQUENCE
    minvalue 1
    maxvalue 1000
    start with 1
    increment by 1
    cache 20;

create sequence InterBranchTransactionSequence
    minvalue 1
    maxvalue 1000
    start with 1
    increment by 1
    cache 20;
create or replace procedure refreshCustomerMv as 
union_clause CLOB:='';
-- dblinkName varchar2(255):='';
begin
  DECLARE CURSOR x is select dblink,branch_name from branch;
  begin
    for y in x LOOP
      begin
        -- dblinkName := REGEXP_SUBSTR(y.dblink, '@.*$', 1, 1);
        -- dblinkName := SUBSTR(dblinkName, 2);
        execute IMMEDIATE 'select 1 from dual@'||y.dblink;
        union_clause:=union_clause||' union select * from '||y.branch_name||'.customer@'||y.dblink;
      EXCEPTION
        WHEN OTHERS then
          DBMS_OUTPUT.PUT_LINE('Dblink ' || y.dblink || ' is not active.');
      end;
    end loop;
  end;  
  EXECUTE IMMEDIATE 'delete from customerFromAllBranch';
  EXECUTE IMMEDIATE 'insert into customerFromAllBranch select * from customer'||union_clause||' order by 1 ';
  -- execute IMMEDIATE 'create or replace materialized view mv_product_asia refresh complete as select * from product'||union_clause;
end refreshCustomerMv;
/
show err;
create or replace PROCEDURE CHECKANDINSERTCUSTOMER 
(
  "Name" IN varchar2 
, contacts IN VARCHAR2 
, "Address" IN VARCHAR2
) AS 
exist number;
errmsg exception;
BEGIN
    refreshCustomerMv;
    select count(*) into exist from customerFromAllBranch mva where mva.contact=contacts;

    if exist=0 then
        dbms_output.put_line('Working');
        insert into customer values('EU'||lpad(sequencecustomerProject.nextval,3,'0'),"Name",contacts,"Address");
        commit;
    else
        dbms_output.put_line('Customer has been registered');
    end if;
END CHECKANDINSERTCUSTOMER;
/
show err;
create or replace procedure insertEmployee
(
    username in varchar2,
    passwordd in varchar2,
    namee in varchar2,
    Addres in varchar2,
    contact in varchar2,
    age in number,
    salary in number,
    position in varchar2
) as 
id varchar2(255):='EMP'||lpad(sequenceEmployee.nextval,3,'0');
begin 
    IF position='manager' then
        insert into employee values(id,username,passwordd,namee,Addres,contact,age,salary,position,sysdate,0);
        execute IMMEDIATE 'create user '||username||' identified by '||passwordd;
        execute IMMEDIATE 'grant role_manager to '||username;
    ELSIF position='staff' then
        insert into employee values(id,username,passwordd,namee,Addres,contact,age,salary,position,sysdate,0);
        execute IMMEDIATE 'create user '||username||' identified by '||passwordd;
        execute IMMEDIATE 'grant role_staff to '||username;
    ELSE
    dbms_output.put_line('Aside from manager or employee other position is not available');
    END IF;
    commit;
end insertEmployee;
/
show err;
create or replace procedure deleteEmployee
(
    usernamee in varchar2
) as
exist number:=0;
begin
    select count(*) into exist from employee where username=usernamee;
    if exist<=0 then
        dbms_output.put_line('No employee with that username exist');
    else
        -- delete from employee where username=usernamee;
        update employee set is_deleted=1 where username=usernamee;
        execute IMMEDIATE 'drop user '||usernamee;
    end if;
    commit;
end deleteEmployee;
/
show err;

-- Restore Deleted Employee
create or replace procedure restoreEmployee
(
    usernamee in varchar2
) as
exist number:=0;
passworddd varchar2(255):='';
roles varchar2(255):='';
begin
    select count(*) into exist from employee where username=usernamee and is_deleted=1;
    if exist<=0 then
        dbms_output.put_line('No employee with that username exist or has been deleted');
    else
        select passwordd,position into passworddd,roles from employee where username=usernamee and is_deleted=1;
        -- delete from employee where username=usernamee;
        update employee set is_deleted=0 where username=usernamee;
        execute IMMEDIATE 'create user '||usernamee||' identified by '||passworddd;
        execute IMMEDIATE 'grant role_'||roles||' to '||usernamee;
    end if;
    commit;
end restoreEmployee;
/
show err;
create or replace procedure refreshmv as 
union_clause CLOB:='';
-- dblinkName varchar2(255):='';
begin
  DECLARE CURSOR x is select dblink,branch_name from branch;
  begin
    for y in x LOOP
      begin
        -- dblinkName := REGEXP_SUBSTR(y.dblink, '@.*$', 1, 1);
        -- dblinkName := SUBSTR(dblinkName, 2);
        execute IMMEDIATE 'select 1 from dual@'||y.dblink;
        union_clause:=union_clause||' union select * from '||y.branch_name||'.product@'||y.dblink;
      EXCEPTION
        WHEN OTHERS then
          DBMS_OUTPUT.PUT_LINE('Dblink ' || y.dblink || ' is not active.');
      end;
    end loop;
  end;  
  EXECUTE IMMEDIATE 'delete from productfromallbranch';
  EXECUTE IMMEDIATE 'insert into productfromallbranch select * from product'||union_clause||' order by 1 ';
  -- execute IMMEDIATE 'create or replace materialized view mv_product_asia refresh complete as select * from product'||union_clause;
end refreshmv;
/
show err;
create or replace PROCEDURE BoughtProductFromOtherBranch 
(
  dblinks in varchar2,
  branch_owners in varchar2,
  product_idd IN varchar2, 
  subtotal IN number 
) AS 
exist number;
-- dblinkName varchar2(255):='';
branch_buyer varchar2(255);
totalPrice number;
dynamic_sql varchar2(4000);
interID varchar2(255):='IBT'||lpad(InterBranchTransactionSequence.nextval,3,0);
BEGIN
    refreshmv;
    select count(*) into exist from productfromallbranch p where p.product_id=product_idd and p.stok>=subtotal and branch_owner=branch_owners and dblink=dblinks;
    select Price into totalPrice from productfromallbranch p where p.product_id=product_idd and p.stok>=subtotal and branch_owner=branch_owners and dblink=dblinks;
    select varvalue into branch_buyer from variable where varname='branch_name';
    if exist<=0 then
        dbms_output.put_line('Product is truly not available sorry');
    else
        -- dblinkName := REGEXP_SUBSTR(dblinks, '@.*$', 1, 1);
        -- dblinkName := SUBSTR(dblinkName, 2);
        totalPrice:=totalPrice*subtotal;
        dynamic_sql := 'UPDATE '|| branch_owners || '.product@' || dblinks || ' SET stok = stok - ' || subtotal || ' WHERE product_id = ''' || product_idd || '''';
        execute IMMEDIATE dynamic_sql;
        commit;
        execute IMMEDIATE 'UPDATE product SET stok = stok + ' || subtotal || ' WHERE product_id = ''' || product_idd || '''';
        commit;
        dynamic_sql := 'INSERT INTO ' || branch_owners || '.interbranchtransaction@' || dblinks || 
               ' VALUES (''' || interID || ''', '''|| branch_buyer ||''', ''' || product_idd || ''', ' || 
               subtotal || ', ' || totalPrice || ', SYSDATE)';
        DBMS_OUTPUT.PUT_LINE('Generated SQL: ' || dynamic_sql);
        EXECUTE IMMEDIATE dynamic_sql;
        commit;
    end if;
    refreshmv;
END BoughtProductFromOtherBranch;
/
show err; 
create or replace procedure INSERTTOPRODUCTUSINGSCHEDULER
(
    names in varchar2,
    types in varchar2,
    prices in number,
    stock in number
    -- ,branch_owners in varchar2,
    -- dblinks in varchar2
) as
-- id varchar2(255):='AS'||lpad(sequenceProduct.nextval,3,'0');
id VARCHAR2(255);
-- dblinkName varchar2(255):='';
syncStatuss varchar2(255):='';
branch_owners varchar2(255):='';
dblinks varchar2(255):='';
begin
    id:= 'PRODUCT_' || RAWTOHEX(SYS_GUID());
    select varvalue into syncStatuss from variable where varname='syncStatus';
    select varvalue into branch_owners from variable where varname='branch_name';
    select varvalue into dblinks from variable where varname='dblink';
    if syncStatuss='active' then
      insert into product values(id,names,types,prices,stock,branch_owners,dblinks);
      DECLARE CURSOR X IS select branch_name,dblink FROM branch;
      BEGIN
          FOR Y IN X LOOP
              begin
                  -- dblinkName := REGEXP_SUBSTR(y.dblink, '@.*$', 1, 1);
                  -- dblinkName := SUBSTR(dblinkName, 2);
                  -- execute IMMEDIATE 'select 1 from dual@'||dblinkName;
                  EXECUTE IMMEDIATE 'INSERT INTO productDummy VALUES (:1,:2,:3,:4,:5,:6,:7,''Not_Yet'')' using
                  id,names,types,prices,stock,Y.branch_name,Y.dblink;
              exception
                  when others then
                      DBMS_OUTPUT.PUT_LINE('Dblink ' || y.dblink || ' is not active.');
                    --   execute IMMEDIATE 'update '||y.Branch_name||'.variable@'||dblinkName||' set varvalue=''inactive'' where varname=''syncStatus''';
              end;
          END LOOP;
      END;
      commit;
    else
      DBMS_OUTPUT.PUT_LINE('Forbidden from inserting a new product. This Database product table is not synchronized yet with other product table of other database.');
    end if;
end INSERTTOPRODUCTUSINGSCHEDULER;
/
show err;
create or replace procedure createTransaction
(
  Employee_idd in varchar2,
  customer_id in varchar2
  -- ,total in number
) as 
HtId varchar2(255):='HT'||lpad(htransSequence.nextval,3,'0');
DtId varchar2(255):='';
Pricess number:=0;
Totals number:=0;
checkk number:=0;
begin
  -- execute IMMEDIATE 'insert into htrans values('''||HtId||''',sysdate,'''||Employee_id||''','''||Customer_id||''',0)';
  insert into htrans values(HtId,sysdate,Employee_idd,customer_id,0);
  declare cursor X is select * from ProductTransaction p where p.Employee_id=Employee_idd;
  begin
    for Y in X loop
      DtId:='DT'||lpad(dtransSequence.nextval,3,'0');
      select Price into Pricess from Product where product_id=Y.product_id;
      Pricess:=Pricess*Y.Quantity;
      Totals:=Totals+Pricess;
      insert into dtrans values(DtId,HtId,Y.product_id,Y.Quantity,Pricess);
      update product set stok=stok-Y.Quantity where product_id=Y.product_id;

      select stok into checkk from product where product_id=Y.product_id;
      if checkk<0 then 
        rollback;
        DBMS_OUTPUT.PUT_LINE('Transaction cancelled due to one or multiple product being unavailable.');
        delete from ProductTransaction p where p.Employee_id=Employee_idd;
        commit;
        return;
      end if;
    end loop;
  end;
  update htrans set Total=Totals where htrans_id=HtId;
  delete from ProductTransaction p where p.Employee_id=Employee_idd;
  commit;
end createTransaction;
/
show err;

create role role_manager;
create role role_staff;
grant connect to role_staff;
grant select on product to role_staff;
grant select, insert, update on customer to role_staff;
grant select, insert, update on htrans to role_staff;
grant select, insert, update on dtrans to role_staff;
grant select, insert, update on ProductTransaction to role_staff;
grant select, insert, update on productFromAllBranch to role_staff;

grant execute on CHECKANDINSERTCUSTOMER to role_staff;
grant execute on createTransaction to role_staff;
grant execute on refreshmv to role_staff;

grant connect to role_manager;
grant select, insert, update on employee to role_manager;
grant select, insert, update on product to role_manager;
grant select, insert, update on HTRANS to role_manager;
grant select, insert, update on DTRANS to role_manager;
grant select, insert, update on productFromAllBranch to role_manager;
grant select, insert, update on branch to role_manager;
grant select, insert, update on customer to role_manager;
grant select, insert, update on INTERBRANCHTRANSACTION to role_manager;

grant execute on insertEmployee to role_manager;
grant execute on deleteEmployee to role_manager;
grant execute on restoreEmployee to role_manager;
grant execute on BoughtProductFromOtherBranch to role_manager;
grant execute on INSERTTOPRODUCTUSINGSCHEDULER to role_manager;
grant execute on refreshmv to role_manager;
GRANT CREATE USER TO role_manager;
insert into variable values('syncStatus','active');
insert into variable values ('branch_name','system');
BEGIN
    DBMS_SCHEDULER.CREATE_JOB(
        job_name        => 'sync_job',
        program_name    => 'program_sync_program',
        schedule_name   => 'sync_schedule',
        enabled         => FALSE,
        auto_drop       => FALSE,
        comments        => 'Job to synchronize product data across branches'
    );
END;
/
show err;

-- the schedule
BEGIN
    DBMS_SCHEDULER.CREATE_SCHEDULE(
        schedule_name => 'sync_schedule',
        start_date    => SYSTIMESTAMP,
        repeat_interval => 'FREQ=SECONDLY; INTERVAL=20',
        end_date      => NULL,
        comments      => 'Runs every 20 seconds'
    );
END;
/
show err;

-- the program
BEGIN
    DBMS_SCHEDULER.CREATE_PROGRAM(
        program_name   => 'program_sync_program',
        program_type   => 'PLSQL_BLOCK',
        program_action => 'BEGIN sync_program(); END;',
        enabled        => TRUE
    );
END;
/
show err;

BEGIN
    DBMS_SCHEDULER.ENABLE('sync_job');
END;
/
show err;


-- the program's procedure
create or replace procedure sync_program as
dblinkName varchar2(255):='';
begin
    DECLARE CURSOR X IS select * FROM productDummy;
      BEGIN
          FOR Y IN X LOOP
              begin
                  dblinkName := REGEXP_SUBSTR(y.dblink, '@.*$', 1, 1);
                  dblinkName := SUBSTR(dblinkName, 2);
                  EXECUTE IMMEDIATE 'INSERT INTO ' ||y.Branch_Owner||'.product@'||y.dblink ||' VALUES (:1,:2,:3,:4,:5,:6,:7)' using
                  Y.product_id,Y."Name",Y."Type",Y.Price,0,Y.branch_owner,Y.dblink;
                  delete from productDummy where product_id=Y.product_id and dblink=Y.dblink;
                  commit;
              exception
                  when others then
                      DBMS_OUTPUT.PUT_LINE('Dblink ' || dblinkName || ' is not active.');
              end;
          END LOOP;
          -- commit;
      END;
    --   delete from productDummy;
      commit;
end sync_program;
/
show err;
4. JALANKAN
- ROBAH
insert into variable values ('dblink','TO_ROBAH');
insert into branch values('system','TO_KENNETH','AMERICA');
insert into branch values('system','TO_VIERY','INDONESIA');
insert into branch values('system','TO_DAHREN','CHINA');
- VIERY
insert into variable values ('dblink','TO_VIERY');
insert into branch values('system','TO_KENNETH','AMERICA');
insert into branch values('system','TO_ROBAH','SINGAPORE');
insert into branch values('system','TO_DAHREN','CHINA');
- KENNETH
insert into variable values ('dblink','TO_KENNETH');
insert into branch values('system','TO_ROBAH','SINGAPORE');
insert into branch values('system','TO_VIERY','INDONESIA');
insert into branch values('system','TO_DAHREN','CHINA');
- DAHREN
insert into variable values ('dblink','TO_DAHREN');
insert into branch values('system','TO_KENNETH','AMERICA');
insert into branch values('system','TO_VIERY','INDONESIA');
insert into branch values('system','TO_ROBAH','SINGAPORE');
5. JALANKAN BERIKUT
CREATE USER konfigurasi IDENTIFIED BY konfigurasi;
GRANT DBA TO konfigurasi ;
6. LOGIN ke konfigurasi
GRANT CREATE USER to system;
GRANT CREATE ROLE to system;
GRANT GRANT ANY ROLE to system;
7. KEMBALI KE system
DECLARE
  USERNAME VARCHAR2(200);
  PASSWORDD VARCHAR2(200);
  NAMEE VARCHAR2(200);
  ADDRES VARCHAR2(200);
  CONTACT VARCHAR2(200);
  AGE NUMBER;
  SALARY NUMBER;
  POSITION VARCHAR2(200);
BEGIN
  USERNAME := 'staff1';
  PASSWORDD := 'staff1';
  NAMEE := 'Stafff Pertama';
  ADDRES := 'Jl Ngangel';
  CONTACT := '081';
  AGE := 20;
  SALARY := 5000000;
  POSITION := 'staff';

  INSERTEMPLOYEE(
    USERNAME => USERNAME,
    PASSWORDD => PASSWORDD,
    NAMEE => NAMEE,
    ADDRES => ADDRES,
    CONTACT => CONTACT,
    AGE => AGE,
    SALARY => SALARY,
    POSITION => POSITION
  );
--rollback; 
END;
DECLARE
  USERNAME VARCHAR2(200);
  PASSWORDD VARCHAR2(200);
  NAMEE VARCHAR2(200);
  ADDRES VARCHAR2(200);
  CONTACT VARCHAR2(200);
  AGE NUMBER;
  SALARY NUMBER;
  POSITION VARCHAR2(200);
BEGIN
  USERNAME := 'manager1';
  PASSWORDD := 'manager1';
  NAMEE := 'Manager Pertama';
  ADDRES := 'Jl Ngangel';
  CONTACT := '081';
  AGE := 20;
  SALARY := 5000000;
  POSITION := 'manager';

  INSERTEMPLOYEE(
    USERNAME => USERNAME,
    PASSWORDD => PASSWORDD,
    NAMEE => NAMEE,
    ADDRES => ADDRES,
    CONTACT => CONTACT,
    AGE => AGE,
    SALARY => SALARY,
    POSITION => POSITION
  );
--rollback; 
END;
