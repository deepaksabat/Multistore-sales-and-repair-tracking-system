Multistore sales and repair tracking system also perfect for tracking for repair product.

Main Feature of SAMS
Products Category
Products Brand
Product Sales with invoice
Product repair tracking module
Saved products
Simple Stock Management
Shops/ Branches
Staffs Management
Message module
Every person log
Set commission from Settings panel

Server Requirements:
--------------------
The Laravel framework 
OpenSSL PHP Extension.
PDO PHP Extension.
Mbstring PHP Extension.
Tokenizer PHP Extension

Installation Instructions:
---------------------
Unzip the source package.
Upload the source directory and files to your server. Normally the root>source>public>index.php file will be at your root.
For database settings, open the .env file with a text editor and set your database settings. 
Note: .env is a hidden file, you can see it by opening directory to a text editor.
Import demo database, demo database located at root>source>db-backup directory
That’s it!

Categories:
--------------
Category use for product sales by more specific. During save product, you have to select a category from there, you can Create/ Add/ Delete a Category.

All Category
See all category that you saved before. Here you can edit or delete, edit delete action only can done by Admin

Add category
You can Create Category in this section, give a category name and click Add Category Button

Brands:
-------
During save product, you have to select a brand from there, you can Create/ Add/ Delete a brand.

Brands
See all brands that you saved before. Here you can edit or delete, edit delete action only can done by Admin

Create Brand
You can Create Brand in this section, give a Brand name and click Add Brand Button

Sales:
--------
During save product, you have to select a brand from there, you can Create/ Add/ Delete a brand.

All Sales
See all sales from from all of your branches/Shops. You can only see sales and its individual invoice with print and download as PDF, can't delete or edit

New sales
Create sales from this saction, just chose a shop if you are admin, staffs no need to chose, they will have shop from login session.
After enter customer information, Add product in this sales by clicking add product Button, you can sale multiple product under one invoice, click submit.

Products:
----------
Products
See all products that you saved before, staffs will see product only if you add a product under their shops/Branch

Add product
Create a product from here in just few click, Select Category, brand, enter product name, Its unite price (This price will be salling price), enter product model, if you want you can enter description. 
Enter Additional Attributes / Product Feature. example for a smartphone: 
Attribute Name: Display, Attribute Value : 6 inch 
Attribute Name: Protection, Attribute Value : Gorilla glass protection 4
Attribute Name: Battery, Attribute Value : 3000 mah 
You can enter unlimited Attribute by clicking Add Attribute Button 
Finally click Add Product Button, your product will save immediately

Stocks:
--------
Note: Only admin can access in this section

You can manage simple stock of your product.

Stocks
All of your saved stock lists will show here, you can add, edit or delete specific stock.

Add stock
you can add stock your any product, just select product that you want to stock, unit price (this price is your purchase price), and total prduct (Stock amount), after clicking Add Stock button, a stock will saved into your system

Transfer to Shop:
----------------
This is allow you to stock product to your shops/branches, To transfer a stock from your mother branch, select shop, select product, and enter Total Product that you want to transfer. Thats it

Shops:
---------
Note: Only admin can access in this section

All of your shops/branches.

Shops
List of your shops/branches that you added before. You can see shop/branch details/products/stock/sales grapch by clicking shops name (shop name is clickable)

Add Shops
To add a shop, click here, fillup that form and click Add Shop Button

Staffs:
-----------
Note: user can access only profile in this section 
Staffs manager will allow you to create staff/ edit/delete them

Add Staffs
Add staff allow you to add a staff to your shops/branches. Also you have to put a initial login credeintial during add a staff

Messages:
-----------
Messages module allow you to send or receive message from your staff or shop manager, your communication just makes easy. you can see message and reply from view option

Settings
Note: Only admin can access in this section

This is application settings page.
