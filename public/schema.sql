
create table users (
    id integer primary key autoincrement,
    name varchar(35) not null check(length(name) <= 35),
    email text not null unique,
    password text not null
);


create table posts (
    id integer primary key autoincrement,
    title text not null,
    image text not null,
    content text not null,
    created_at datetime default current_timestamp,
    user_id integer not null,
    foreign key (user_id) references users(id) on delete cascade,
    foreign key (category_id) references categories(id) on delete cascade
);


create table categories(
    id integer primary key autoincrement,
    name varchar(50) not null

)