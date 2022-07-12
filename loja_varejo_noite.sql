-- drop database if exists loja_varejo;
create database if not exists loja_varejo;
use loja_varejo;
create table if not exists address(
address_code int auto_increment,
    public_place varchar(30) not null,
    number_of_street varchar(10) not null,
    complement varchar(10) not null,
    neighborhood varchar(30) not null,
    city varchar(30) not null,
    zip_code char(8) not null,
    primary key(address_code)
);
create table if not exists provider(
cnpj char(14),
    provider_name varchar(50) not null,
    phone varchar(15),
    address_code int,
    primary key(cnpj),
constraint address_code foreign key (address_code) references address(address_code)
);
create table if not exists product(
	product_code int auto_increment,
    product_name varchar(40) not null,
    price float not null,
    quantity int,
    primary key(product_code)
    );
create table if not exists provider_product(
	provider_cnpj char(14),
    product_code int,
    primary key(provider_cnpj, product_code),
    foreign key(provider_cnpj) references provider (cnpj),
    foreign key(product_code) references product (product_code)
);
   
insert into address(
address_code,
    public_place,
    number_of_street,
    complement,
    neighborhood,
    city,
    zip_code
)values(
null,
'Avenida',
797,
"casa",
'Pedreira',
'Belém',
'66085317'
);
insert into provider()values(
	'12345678912345','construcoes badanha','null','1'
);
insert into address()values(
	null,'casa','23','longe','barnabé','gravatai','23234345'
);
alter table address add column street_name varchar(40) not null after public_place;

describe  provider;
select * from provider;

insert into product()values(null,'bolacha trakinas de banana',2.00,100);
insert into product()values(null,'Guaraná pichula',1.50,200);
insert into product()values(null,'bala 7 belo pacote de 2kg',20,400);

insert into provider()values('40494444000145','Jaqueline e osvaldo adega lda',"(11)3535-1105",2);

-- buscar so o nome e preco
select product_name , price from product;

-- buscar todos os dados, com filtro
select *from product where product_code = 3;
select *from product where price >= 2;
select *from product where quantity between 200 and 400;
select *from product where quantity between 200 and 400 or price > 2;
select count(*)  from product where quantity between 100 and 200;
-- as 'Média de preços' é um apelido
select avg(price) as 'Média de preços' from product;
select * from product order by quantity;
select * from product order by price desc;