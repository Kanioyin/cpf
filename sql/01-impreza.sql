create table impreza
(
    id      integer not null
        constraint impreza_pk
            primary key autoincrement,
    subject text not null,
    content text not null,
    date text not null
);