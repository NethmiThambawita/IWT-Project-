CREATE TABLE Account(
 AccountID INT IDENTITY (20001,1),
 AccountPwd VARCHAR(40)NOT NULL,
 Account_type VARCHAR(50)NOT NULL,
 
 CONSTRAINT Account_PK PRIMARY KEY (AccountID),
 
);
CREATE TABLE Registered_User(
 UserID INT IDENTITY(1001,1),
 F_Name VARCHAR(40)NOT NULL,
 L_name VARCHAR(50)NOT NULL,
 DOB DATE,
 AccountID INT NOT NULL,
 CONSTRAINT Registered_Users_PK PRIMARY KEY (UserID),
 CONSTRAINT Registered_Users_FK1 FOREIGN KEY(AccountID) REFERENCES Account
(AccountID),
);
CREATE TABLE User_Contact(
 UserID INT NOT NULL,
 Contact_no INT NOT NULL,
 
 CONSTRAINT User_Contacts_PK PRIMARY KEY (UserID,Contact_no),
 CONSTRAINT User_Contacts_FK1 FOREIGN KEY(UserID) REFERENCES
Registered_User(UserID),
 CONSTRAINT CHK_Contact CHECK(Contact_no BETWEEN 0000000000 AND 9999999999)
);
CREATE TABLE User_Email(
 UserID INT NOT NULL,
 Email VARCHAR(100)NOT NULL,
 
 CONSTRAINT User_Email_PK PRIMARY KEY (UserID,Email),
 CONSTRAINT User_Email_FK1 FOREIGN KEY(UserID) REFERENCES Registered_User(UserID),
 CONSTRAINT CHK_Email CHECK(Email LIKE '%_@__%.__%')
 );
 CREATE TABLE Staff(
 EmpID INT IDENTITY (30001,1),
 eF_Name VARCHAR(40)NOT NULL,
 eL_name VARCHAR(50)NOT NULL,
 Employee_type VARCHAR(40)NOT NULL,
 eDOB DATE,
 AccountID INT NOT NULL,
 
 CONSTRAINT Staff_PK PRIMARY KEY (EmpID),
 CONSTRAINT Staff_FK1 FOREIGN KEY(AccountID) REFERENCES Account (AccountID),
 CONSTRAINT CHK_EmployeeType CHECK (Employee_type IN('Admin','Inquiry 
Manager','Billing Manager','Event Manager','Finance Manager'))
);
CREATE TABLE Staff_Email(
 EmpID INT NOT NULL,
 eEmail VARCHAR(100)NOT NULL,
 
 CONSTRAINT Staff_Email_PK PRIMARY KEY (EmpID,eEmail),
 CONSTRAINT Staff_Email_FK1 FOREIGN KEY(EmpID) REFERENCES Staff (EmpID),
 CONSTRAINT CHK_Email_E CHECK(eEmail LIKE '%_@__%.__%')
);
CREATE TABLE Staff_Contacts(
 EmpID INT NOT NULL,
 eContact_no VARCHAR(20)NOT NULL,
 
 CONSTRAINT Staff_Contacts_PK PRIMARY KEY (EmpID,eContact_no),
 CONSTRAINT Staff_Contacts_FK1 FOREIGN KEY(EmpID) REFERENCES Staff (EmpID),
 CONSTRAINT CHK_eContact CHECK(eContact_no BETWEEN 0000000000 AND 9999999999)
);
CREATE TABLE Report(
 ReportID INT IDENTITY (001,1),
 Descriptions VARCHAR(100)NOT NULL,
 R_Type VARCHAR(50)NOT NULL,
 R_Status VARCHAR(50)NOT NULL,
 R_Date DATE,
 AccountID INT NOT NULL,
 CONSTRAINT Report_PK PRIMARY KEY (ReportID),
 CONSTRAINT Report_FK FOREIGN KEY (AccountID) REFERENCES Account(AccountID)
 
);
CREATE TABLE Alerts(
 AlertID INT IDENTITY (401,1),
 UserID INT NOT NULL,
 A_Descriptions VARCHAR(200)NOT NULL,
 Al_Type VARCHAR(50)NOT NULL,
 Al_Status VARCHAR(50)NOT NULL,
 R_Date DATE,
 AccountID INT NOT NULL,
 CONSTRAINT Alerts_PK PRIMARY KEY(AlertID,UserID),
 CONSTRAINT Alerts_FK1 FOREIGN KEY(UserID) REFERENCES Registered_User(UserID),
 CONSTRAINT Alerts_FK2 FOREIGN KEY(AccountID) REFERENCES Account (AccountID) 
);
CREATE TABLE Inquiry(
 UserID INT NOT NULL,
 InquiryID INT IDENTITY (101,1),
 Reference_Number VARCHAR (20) NOT NULL,
 I_Date DATE,
 Subjects VARCHAR (200) NOT NULL,
 EmpID INT NOT NULL,
 CONSTRAINT Inquiry_PK PRIMARY KEY (UserID, InquiryID),
 CONSTRAINT Inquiry_FK1 FOREIGN KEY(UserID) REFERENCES Registered_User(UserID),
 CONSTRAINT Inquiry_FK2 FOREIGN KEY(EmpID) REFERENCES Staff(EmpID),
);
CREATE TABLE Billing(
 BillNo INT IDENTITY (201,1),
 BillName VARCHAR(20) NOT NULL,
 Bill_Value INT NOT NULL,
 Bill_type VARCHAR(20) NOT NULL,
 UserID INT NOT NULL,
 AccountID INT NOT NULL,
 due_date DATE,
 CONSTRAINT Billing_PK PRIMARY KEY (BillNo),
 CONSTRAINT Billing_FK1 FOREIGN KEY(UserID)REFERENCES Registered_User(UserID),
 CONSTRAINT Billing_FK2 FOREIGN KEY(AccountID)REFERENCES Account(AccountID)
);
CREATE TABLE Reads(
 BillNo INT NOT NULL,
 EmpID INT NOT NULL,
 CONSTRAINT Reads_PK PRIMARY KEY(BillNo,EmpID),
 CONSTRAINT Reads_FK1 FOREIGN KEY(BillNo)REFERENCES Billing(BillNo),
 CONSTRAINT Reads_FK2 FOREIGN KEY(EmpID)REFERENCES Staff(EmpID)
);
CREATE TABLE Reminders(
 ReminderID INT IDENTITY(901,1),
 Rim_Date DATE,
 R_Status VARCHAR(50) NOT NULL,
 R_Type VARCHAR(50) NOT NULL,
 CONSTRAINT Reminders_PK PRIMARY KEY(ReminderID)
);
CREATE TABLE Sends(
 UserID INT NOT NULL,
 ReminderID INT NOT NULL,
 CONSTRAINT sends_PK PRIMARY KEY(UserID,ReminderID),
 CONSTRAINT Send_FK1 FOREIGN KEY(UserID)REFERENCES Registered_User(UserID),
 CONSTRAINT Send_FK2 FOREIGN KEY(ReminderID)REFERENCES Reminders(ReminderID)
);
CREATE TABLE Budget(
 BudgetID INT IDENTITY(7001,1),
 B_Date DATE,
 UserID INT NOT NULL,
 EmpID INT NOT NULL ,
 Income INT NOT NULL,
 Expense INT NOT NULL,
 Savings INT NOT NULL,
 CONSTRAINT Budget_PK PRIMARY KEY(BudgetID,UserID),
 CONSTRAINT Budget_FK1 FOREIGN KEY(UserID)REFERENCES Registered_User(UserID),
 CONSTRAINT Budget_FK2 FOREIGN KEY(EmpID)REFERENCES Staff(EmpID)
);
CREATE TABLE Events_B(
 EventID INT IDENTITY(6001,1),
 E_Date DATE,
 UserID INT NOT NULL,
 EventName VARCHAR(200) NOT NULL,
 Locations VARCHAR(200) NOT NULL,
 CONSTRAINT Events_B_PK PRIMARY KEY(EventID,UserID),
 CONSTRAINT Events_B_FK1 FOREIGN KEY(UserID)REFERENCES Registered_User(UserID)
);
CREATE TABLE Submits(
 ReportID INT NOT NULL,
 EmpID INT NOT NULL,
 CONSTRAINT Submits_PK PRIMARY KEY(ReportID,EmpID),
 CONSTRAINT Submits_FK1 FOREIGN KEY(ReportID)REFERENCES Report(ReportID),
 CONSTRAINT Submits_FK2 FOREIGN KEY(EmpID)REFERENCES Staff(EmpID)
);
CREATE TABLE Monitors(
 UserID INT NOT NULL,
 EmpID INT NOT NULL,
 CONSTRAINT Monitors_PK PRIMARY KEY(UserID,EmpID),
 CONSTRAINT Monitors_FK1 FOREIGN KEY(UserID)REFERENCES Registered_User(UserID),
 CONSTRAINT Monitors_FK2 FOREIGN KEY(EmpID)REFERENCES Staff(EmpID)
);
CREATE TABLE Investigates(
 UserID INT NOT NULL,
 AlertID INT NOT NULL,
 EmpID INT NOT NULL,
 CONSTRAINT Investigates_PK PRIMARY KEY(UserID,EmpID,AlertID),
 CONSTRAINT Investigates_FK1 FOREIGN KEY(AlertID,UserID)REFERENCES
Alerts(AlertID,UserID),
 CONSTRAINT Investigates_FK2 FOREIGN KEY(EmpID)REFERENCES Staff(EmpID)
);
CREATE TABLE Setting(
 ReminderID INT NOT NULL,
 EmpID INT NOT NULL,
 CONSTRAINT Setting_PK PRIMARY KEY(ReminderID,EmpID),
 CONSTRAINT Setting_FK1 FOREIGN KEY(ReminderID)REFERENCES Reminders(ReminderID),
 CONSTRAINT Setting_FK2 FOREIGN KEY(EmpID)REFERENCES Staff(EmpID)
);









INSERT INTO Account (AccountPwd,Account_type)
VALUES('2002@ms','User')
INSERT INTO Account (AccountPwd,Account_type)
VALUES('304fr5','Staff')
INSERT INTO Account (AccountPwd,Account_type)
VALUES('2dl*3mM','Staff')
INSERT INTO Account (AccountPwd,Account_type)
VALUES('3D4k$dwme','User')
INSERT INTO Account(AccountPwd,Account_type)
VALUES('43j#msMS','User')
INSERT INTO Account (AccountPwd,Account_type)
VALUES('MSD%dl*3mM','Staff')
INSERT INTO Account (AccountPwd,Account_type)
VALUES('2dl*3&2VSM','Staff')
INSERT INTO Account (AccountPwd,Account_type)
VALUES('2SDFSl*3mM','Staff')
INSERT INTO Account (AccountPwd,Account_type)
VALUES('*HE&hdwme','User')
INSERT INTO Account(AccountPwd,Account_type)
VALUES('DVFMmsMS','User')
INSERT INTO Account(AccountPwd,Account_type)
VALUES('ERFO0j#msMS','User')

INSERT INTO Registered_User (F_Name,L_Name,DOB,AccountID)
VALUES('Dinidu','Ekanayaka','2000/01/7',20001)
INSERT INTO Registered_User (F_Name,L_Name,DOB,AccountID)
VALUES('Isiri','Thuduwagama','1999/03/07',20004)
INSERT INTO Registered_User (F_Name,L_Name,DOB,AccountID)
VALUES('Yasiri','Karunarathilaka','1998/07/01',20005)
INSERT INTO Registered_User (F_Name,L_Name,DOB,AccountID)
VALUES('Kusali','Doranadiwala','1878/09/02',20009)
INSERT INTO Registered_User (F_Name,L_Name,DOB,AccountID)
VALUES('Purni','Manchanayake','1959/04/09',20010)

INSERT INTO User_Contact (UserID,Contact_no)
VALUES (1001,0701260526)
INSERT INTO User_Contact (UserID,Contact_no)
VALUES (1002,0710355950)
INSERT INTO User_Contact (UserID,Contact_no)
VALUES(1003,0714433309)
INSERT INTO User_Contact (UserID,Contact_no)
VALUES(1004,0773783510)
INSERT INTO User_Contact (UserID,Contact_no)
VALUES(1005,0771233390)

INSERT INTO User_Email (UserID,Email)
VALUES (1001,'dinidu.ekanayaka@gmail.com')
INSERT INTO User_Email (UserID,Email)
VALUES(1002,'ranaweeraduvini02@gmail.com')
INSERT INTO User_Email (UserID,Email)
VALUES(1003,'uvini.ranaweeera123@gmail.com')
INSERT INTO User_Email (UserID,Email)
VALUES(1004,'pabasaara@gmail.com')
INSERT INTO User_Email (UserID,Email)
VALUES(1005,'malinih05@gmail.com')


INSERT INTO Staff (eF_Name,eL_Name,Employee_Type,eDOB,AccountID)
VALUES('Malith','Ekanayake','Admin','2000/01/07',20002)
INSERT INTO Staff(eF_Name,eL_Name,Employee_Type,eDOB,AccountID)
VALUES('Isuru','Thuduwage','Billing Manager','1999/03/07',20003)
INSERT INTO Staff (eF_Name,eL_Name,Employee_Type,eDOB,AccountID)
VALUES('Yasiru','Karunarathna','Inquiry Manager','1998/10/07',20006)
INSERT INTO Staff (eF_Name,eL_Name,Employee_Type,eDOB,AccountID)
VALUES('Kusal','Doranagoda','Event Manager','1879/10/02',20007)
INSERT INTO Staff (eF_Name,eL_Name,Employee_Type,eDOB,AccountID)
VALUES('Purna','Ekanayaka','Finance Manager','1959/02/24',20008)

INSERT INTO Staff_Contacts (EmpID,eContact_no)
VALUES (30001,0701223526)
INSERT INTO Staff_Contacts (EmpID,eContact_no)
VALUES (30002,0710345950)
INSERT INTO Staff_Contacts (EmpID,eContact_no)
VALUES(30003,0746783309)
INSERT INTO Staff_Contacts (EmpID,eContact_no)
VALUES(30004,0734563510)
INSERT INTO Staff_Contacts (EmpID,eContact_no)
VALUES(30005,0776783390)

INSERT INTO Staff_Email (EmpID,eEmail)
VALUES (30001,'malindu.ekanayaka@gmail.com')
INSERT INTO Staff_Email (EmpID,eEmail)
VALUES(30002,'ranawesdsknsivini02@gmail.com')
INSERT INTO Staff_Email (EmpID,eEmail)
VALUES(30003,'sdsnlseera123@gmail.com')
INSERT INTO Staff_Email (EmpID,eEmail)
VALUES(30004,'pdssvmkra@gmail.com')
INSERT INTO Staff_Email (EmpID,eEmail)
VALUES(30005,'masdfsdv@gmail.com')

INSERT INTO Alerts (UserID,A_Descriptions,Al_Type ,Al_Status,R_Date ,AccountID)
VALUES (1001,'Password Incorrect','User','In Progress','2023/05/10',20001)
INSERT INTO Alerts (UserID,A_Descriptions,Al_Type ,Al_Status,R_Date ,AccountID)
VALUES(1002,'Unauthorized Access', 'User','Completed','2023/04/10',20004)
INSERT INTO Alerts (UserID,A_Descriptions,Al_Type ,Al_Status,R_Date ,AccountID)
VALUES(1003,'Access Denied','System','In Progress','2023/05/10',20005)
INSERT INTO Alerts (UserID,A_Descriptions,Al_Type ,Al_Status,R_Date ,AccountID)
VALUES(1005,'Account Expired','User','In Progress','2023/05/21',20009)
INSERT INTO Alerts (UserID,A_Descriptions,Al_Type ,Al_Status,R_Date ,AccountID)

VALUES(1004,'Password Incorrect','System','In Progress','2023/06/10',20010)

INSERT INTO Report (Descriptions,R_Type,R_status,R_Date,AccountID)
VALUES('Month-Transactions','Finance','In progress','2023/05/01',20008)
INSERT INTO Report (Descriptions,R_Type,R_status,R_Date,AccountID)
VALUES('Month End Report','Billing','In progress','2023/05/21',20003)
INSERT INTO Report (Descriptions,R_Type,R_status,R_Date,AccountID)
VALUES('overall report','Admin','Completed','2023/04/30',20002)
INSERT INTO Report (Descriptions,R_Type,R_status,R_Date,AccountID)
VALUES('Month end report','Finance','In progress','2023/05/21',20008)
INSERT INTO Report (Descriptions,R_Type,R_status,R_Date,AccountID)
VALUES('Month-end report','Event','In progress','2023/05/25',20007)

INSERT INTO INQUIRY (UserID,Reference_Number,I_Date,Subjects,EmpID)
VALUES(1001,'RI12345','2023/01/07','payment not completed',30002)
INSERT INTO INQUIRY (UserID,Reference_Number,I_Date,Subjects,EmpID)
VALUES(1002,'RI45359','2023/05/20','EventS not visible',30004)
INSERT INTO INQUIRY (UserID,Reference_Number,I_Date,Subjects,EmpID)
VALUES(1003,'RI96532','2023/03/23','Can not delete history',30001)
INSERT INTO INQUIRY (UserID,Reference_Number,I_Date,Subjects,EmpID)
VALUES(1004,'RI42359','2023/04/25','Event Issues',30004)
INSERT INTO INQUIRY(UserID,Reference_Number,I_Date,Subjects,EmpID)
VALUES(1005,'RI78423','2023/05/29','Can not create budget',30005)

INSERT INTO Billing (BillName,Bill_Value,Bill_type,UserID,AccountID,due_date)
VALUES ('SLT',1000.00,'Utility',1001,20001,'2023/04/01')
INSERT INTO Billing (BillName,Bill_Value,Bill_type,UserID,AccountID,due_date)
VALUES('chamud Food',4000.00,'Event',1002,20004,'2023/06/12')
INSERT INTO Billing (BillName,Bill_Value,Bill_type,UserID,AccountID,due_date)
VALUES('CEB',7000.00,'Utility',1001,20001,'2023/09/07')
INSERT INTO Billing (BillName,Bill_Value,Bill_type,UserID,AccountID,due_date)
VALUES('Naduni Bridal',3000.00,'Event',1003,20005,'2023/04/23')
INSERT INTO Billing (BillName,Bill_Value,Bill_type,UserID,AccountID,due_date)
VALUES('Nadu Traders',5000.00,'Event',1003,20005,'2023/05/23')

INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/06/01','Active','Birthday')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/05/01','Inactive','Wedding')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/04/01','Active','Arlms giving')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/06/09','Active','Birthday')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/07/16','Active','Party')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/07/01','Active','Water Bill')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/06/01','Active','Phone Bill')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/05/31','Active','Party Venue')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)
VALUES('2023/06/30','Active','Electricity Bill')
INSERT INTO Reminders (Rim_Date,R_Status,R_Type)

VALUES('2023/08/01','Active','Food Bill')
INSERT INTO Budget (B_Date,UserID,EmpID,Income,Expense,Savings)
VALUES('2023/02/28',1001,30005,10000.00,20000.00,0.0)
INSERT INTO Budget (B_Date,UserID,EmpID,Income,Expense,Savings)
VALUES('2023/03/31',1002,30005,14000.00,10000.00,1000.0)
INSERT INTO Budget (B_Date,UserID,EmpID,Income,Expense,Savings)
VALUES('2023/04/30',1004,30005,0.00,2000.00,0.0)
INSERT INTO Budget (B_Date,UserID,EmpID,Income,Expense,Savings)
VALUES('2023/01/31',1003,30005,0.00,25000.00,100000.0)
INSERT INTO Budget (B_Date,UserID,EmpID,Income,Expense,Savings)
VALUES('2022/01/01',1001,30005,0.00,10000.00,0.00)

INSERT INTO Events_B (E_Date,UserID,EventName,Locations)
VALUES('2023/06/28',1001,'Nammi Wedding','Shangrilla')
INSERT INTO Events_B (E_Date,UserID,EventName,Locations)
VALUES('2023/05/28',1002,'Mali Wedding','Waters Edge')
INSERT INTO Events_B (E_Date,UserID,EventName,Locations)
VALUES('2023/06/09',1003,'Anniverssary','Kandy')
INSERT INTO Events_B (E_Date,UserID,EventName,Locations)
VALUES('2023/05/25',1004,'Father Birthday','OGF')
INSERT INTO Events_B (E_Date,UserID,EventName,Locations)
VALUES('2023/07/28',1001,'Pula Wedding','Negambo')

INSERT INTO Sends (UserID,ReminderID)
VALUES(1001,901)
INSERT INTO Sends (UserID,ReminderID)
VALUES(1002,902)
INSERT INTO Sends (UserID,ReminderID)
VALUES(1003,903)
INSERT INTO Sends (UserID,ReminderID)
VALUES(1003,904)
INSERT INTO Sends (UserID,ReminderID)
VALUES(1005,905)

INSERT INTO Reads (BillNo,EmpID)
VALUES(201,30001)
INSERT INTO Reads (BillNo,EmpID)
VALUES(202,30002)
INSERT INTO Reads (BillNo,EmpID)
VALUES(203,30002)
INSERT INTO Reads (BillNo,EmpID)
VALUES(204,30002)
INSERT INTO Reads (BillNo,EmpID)
VALUES(205,30001)

INSERT INTO Submits (ReportID,EmpID)
VALUES(1,30005)
INSERT INTO Submits (ReportID,EmpID)
VALUES(2,30002)
INSERT INTO Submits (ReportID,EmpID)
VALUES(3,30001)
INSERT INTO Submits (ReportID,EmpID)
VALUES(4,30005)
INSERT INTO Submits (ReportID,EmpID)
VALUES(5,30004)

INSERT INTO Monitors (UserID,EmpID)
VALUES(1001,30001)
INSERT INTO Monitors (UserID,EmpID)
VALUES(1002,30003)
INSERT INTO Monitors (UserID,EmpID)
VALUES(1003,30001)
INSERT INTO Monitors (UserID,EmpID)
VALUES(1004,30001)
INSERT INTO Monitors (UserID,EmpID)
VALUES(1005,30001)

INSERT INTO Setting (ReminderID,EmpID)
VALUES(901,30004)
INSERT INTO Setting (ReminderID,EmpID)
VALUES(902,30004)
INSERT INTO Setting (ReminderID,EmpID)
VALUES(903,30004)
INSERT INTO Setting (ReminderID,EmpID)
VALUES(904,30004)
INSERT INTO Setting (ReminderID,EmpID)
VALUES(906,30002)

INSERT INTO Investigates (UserID,AlertID,EmpID)
VALUES(1001,401,30001)
INSERT INTO Investigates (UserID,AlertID,EmpID)
VALUES(1002,402,30001)
INSERT INTO Investigates (UserID,AlertID,EmpID)
VALUES(1003,403,30003)
INSERT INTO Investigates (UserID,AlertID,EmpID)
VALUES(1005,404,30001)
INSERT INTO Investigates (UserID,AlertID,EmpID)
VALUES(1004,405,30003)







