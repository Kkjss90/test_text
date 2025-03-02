create table history
(
    id         serial
        primary key,
    text       text        not null,
    language   varchar(10) not null,
    created_at timestamp default CURRENT_TIMESTAMP
);