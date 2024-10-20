
create table items (
	sku varchar(256) not null,
	name varchar(1024) not null,
	price float not null,
	primary key (sku));

create table dvds (
	sku varchar(256) not null,
	size float not null,
	foreign key (sku) references items (sku) on delete cascade);
	
create table books (
	sku varchar(256) not null,
	weight float not null,
	foreign key (sku) references items (sku) on delete cascade);
	
create table furnitures (
	sku varchar(256) not null,
	width float not null,
	height float not null,
	length float not null,
	foreign key (sku) references items (sku) on delete cascade);