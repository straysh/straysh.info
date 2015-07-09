insert into strayshInfo.article
select a.id,'post', 1, a.nav_id, a.author, a.title, a.title,0, c.content, a.c_time,a.c_time,a.c_time,null
from s_blog.s_article a, s_blog.s_article_content c where a.id=c.article_id;

insert into strayshInfo.category
select id,pid,nav_name,nav_cn,LOWER(nav_name),total,`order`,null,m_time,m_time,null
from s_blog.s_category;


drop database if exists `strayshInfo`;
create database `strayshInfo`;
use `strayshInfo`;
