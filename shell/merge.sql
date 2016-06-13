-- 备份原始数据
create database IF NOT EXISTS straysh_old;
mysqldump strayshInfo > storage/strayshInfo.sql;
mysql straysh_old < storage/strayshInfo.sql;

-- 新数据覆盖
mysql strayshInfo < storage/t.sql;

-- 恢复hits字段
update strayshInfo t,straysh_old o set t.hits=o.hits where t.id=o.id;