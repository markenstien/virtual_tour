create table poi_image_galleries(
    id int(10) not null primary key auto_increment,
    poi_id int(10) not null,
    file_name varchar(100),
    file_path varchar(100) comment 'server-source-complete',
    file_url varchar(100)  comment 'server-source-url-complete',
    is_default_bg boolean default true,
    created_at timestamp default now(),
    updated_at timestamp default now() ON UPDATE now()
);



alter table visitor_tbl
    add column visit_session varchar(100);



/*
*new tables 
*/

create table poi_categories(
    id int(10) not null primary key auto_increment,
    category_name varchar(100),
    poi_order tinyint,
    created_at timestamp default now()
);

alter table pic_tbl 
    add column category_id int(10)