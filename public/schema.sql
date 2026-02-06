create table users (
    id integer primary key autoincrement,
    name varchar(35) not null check(length(name) <= 35),
    email text not null unique,
    password text not null,
    role text not null -- 'admin' or 'user'
);

create table categories(
    id integer primary key,
    name text not null
);

create table posts (
    id integer primary key autoincrement,
    title text not null,
    image text not null, -- Stores the filename/path
    content text not null,
    created_at datetime default current_timestamp,
    user_id integer not null,
    category_id integer not null, 
    foreign key (user_id) references users(id) on delete cascade,
    foreign key (category_id) references categories(id) on delete cascade 
);

-- default categories to choose from
insert into categories (id, name) values 
(1, 'Technology'),
(2, 'Lifestyle'),
(3, 'Travel'),
(4, 'Food'),
(5, 'Other');