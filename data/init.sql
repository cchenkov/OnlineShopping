CREATE DATABASE onlinestore;

USE onlinestore;

CREATE TABLE User (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    FirstName VARCHAR(30) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(15) NOT NULL


CREATE TABLE Product(
	Id INT AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(20),
	User_id INT,
	
	FOREIGN KEY (User_id) REFERENCES User(Id)
);

CREATE TABLE Comment (
	Id INT AUTO_INCREMENT PRIMARY KEY,
    User_id INT,
    Product_id INT,
    Message VARCHAR(100),
    
    FOREIGN KEY (User_id) REFERENCES User(Id),
    FOREIGN KEY (Product_Id) REFERENCES Product(Id)
);

CREATE TABLE Rating(
	Id INT AUTO_INCREMENT PRIMARY KEY,
    User_id INT,
    Product_id INT,
    Value INT,
    
    FOREIGN KEY (User_id) REFERENCES User(Id),
    FOREIGN KEY (Product_Id) REFERENCES Product(Id)
);