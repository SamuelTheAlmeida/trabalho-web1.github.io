create database spotted;
use spotted;

create table usuarios(
	idUsuario int not null primary key auto_increment,
    nickname varchar(20) not null,
    senha varchar(32) not null,
    telefone varchar(15),
    email varchar(50),
    isAdmin boolean not null default 0
);

create table categorias(
	idCategoria int not null primary key auto_increment,
    nomeCategoria varchar(20)
);

create table posts(
	idPost int not null primary key auto_increment,
    idUsuario int,
    idCategoria int,
    conteudoPost varchar(300) not null check(conteudoPost >= 13),
    dataHoraPost datetime,
    aprovado boolean not null default 0,
    foreign key (idCategoria) references categorias(idCategoria),
    foreign key (idUsuario) references usuarios(idUsuario)
);

 

