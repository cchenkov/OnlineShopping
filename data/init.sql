DROP DATABASE IF EXISTS onlinestore;
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
);

CREATE TABLE Product (
	ProductId INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(100) NOT NULL,
    ProductType VARCHAR(20) NOT NULL,
    Description VARCHAR(100) NOT NULL,
    Stock INT NOT NULL,
    Price INT NOT NULL,
    ImageSource VARCHAR(50) NOT NULL
);

CREATE TABLE Cart(
	CardId INT AUTO_INCREMENT PRIMARY KEY,
    MemberId INT NOT NULL,
    ProductId INT NOT NULL,
    Quantity INT NOT NULL,
    FOREIGN KEY (MemberId) REFERENCES User(Id),
    FOREIGN KEY (ProductId) REFERENCES Product(ProductId)
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