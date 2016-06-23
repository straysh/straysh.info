#!/usr/bin/env bash
# 备份原始数据
echo "create database IF NOT EXISTS straysh_old"
mysql -e "create database IF NOT EXISTS straysh_old"

echo "backup strayshInfo"
mysqldump strayshInfo > storage/strayshInfo.sql
mysql straysh_old < storage/strayshInfo.sql

# 新数据覆盖
echo "restore latest data into strayshInfo"
mysql strayshInfo < storage/t.sql

# 恢复hits字段
echo "restore hits"
mysql -e "update strayshInfo.article t,straysh_old.article o set t.hits=o.hits where t.id=o.id"