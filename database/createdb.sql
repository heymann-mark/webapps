drop database if exists sandwichdb; -- only for your server
create database sandwichdb; -- only for your own server
use sandwichdb;  -- only for your own server


-- using auto_increment for new ids where needed--
create table sandwich_size(
id integer not null auto_increment,
s_status integer not null,  -- 0 = inactive, 1 = active
size_name varchar(30) not null,
primary key (id),
unique (size_name));



create table toppings(
id integer not null auto_increment,
t_status integer not null,  -- 0 = inactive, 1 = active
topping_name varchar(30) not null,
primary key(id),
unique (topping_name));

-- using auto_increment for new ids where needed--
create table bread_type(
id integer not null auto_increment,
b_status integer not null,  -- 0 = inactive, 1 = active
bread_name varchar(30) not null,
primary key (id),
unique (bread_name));

create table meats(
id integer not null auto_increment,
m_status integer not null,  -- 0 = inactive, 1 = active
meat_name varchar(30) not null,
primary key (id),
unique (meat_name)
);

create table sauces(
id integer not null auto_increment,
sau_status integer not null,  -- 0 = inactive, 1 = active
sauce_name varchar(30) not null,
primary key (id),
unique (sauce_name));

create table sandwich_orders(
id integer not null auto_increment,
customer_id integer not null,
size_id integer,
bread_id integer not null,
day integer not null,
status integer not null, -- 1 , 2, 3
primary key(id),
foreign key (size_id) references sandwich_size(id),
foreign key (bread_id) references bread_type(id)
);



create table order_topping(
order_id integer not null,
topping_id integer not null,
primary key (order_id, topping_id),
foreign key (order_id) references sandwich_orders (id),
foreign key (topping_id) references toppings(id)
);

create table order_sauce (
order_id integer not null,
sauce_id integer not null,
primary key (order_id, sauce_id),
foreign key (order_id) references sandwich_orders(id),
foreign key (sauce_id) references sauces(id)
);

create table order_meat (
order_id integer not null,
meat_id integer not null,
primary key (order_id, meat_id),
foreign key (order_id) references sandwich_orders(id),
foreign key (meat_id) references meats(id)
);


-- Use the next_xxx_ids instead of auto_increment if you want
create table sandwich_sys_tab(
next_order_id integer not null,
next_topping_id integer not null,
next_sandwich_size_id integer not null,
next_sauce_id integer not null,
next_bread_type_id integer not null,
next_meat_type_id integer not null,
current_day integer not null);

insert into sandwich_sys_tab values (1, 1, 1, 1, 1, 1, 1);

-- minimal toppings and sizes: one each
insert into toppings values (1,1,'Tomatoes');
insert into toppings values (2,1,'Lettuce');
insert into toppings values (3,1,'Onions');

insert into bread_type values (1,1,'White');
insert into bread_type values (2,1,'Wheat');
insert into bread_type values (3,1,'Wrap');

insert into sandwich_size values (1,1,'Small');
insert into sandwich_size values (2,1,'medium');
insert into sandwich_size values (3,1,'large');

insert into sauces values (1,1,'Italian');
insert into sauces values (2,1,'Mayo');
insert into sauces values (3,1,'Mustard');
insert into sauces values (4,1,'Oil');
insert into sauces values (5,1,'Vinegar');

insert into meats values(1,1,'Veggie');
insert into meats values(2,1,'Turkey');
insert into meats values(3,1,'Salami');
insert into meats values(4,1,'Beef');
