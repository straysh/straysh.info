#!/bin/bash

#echo -n '===> web <=== is going be compressed.Are U SURE?(or Enter "recp") :'
#read needbackup
#if [ -z ${needbackup} ];then
#    needbackup='web';
#fi
#
#if [ ${needbackup} = 'web' ];then
#    echo "${needbackup} is going to be compressed!"
#elif [ ${needbackup} = 'recp' ];then
#    echo "${needbackup} is going to be compressed!"
#else
#    echo "${needbackup} is invalid!";
#    exit 0
#fi


currentDir=$(cd `dirname $0` && pwd -P)
publishPath=${currentDir}/../../js
devPath=${currentDir}/../../js_develop
distPath=${currentDir}/../../js_dist
pubCssPath=${currentDir}/../../css
devCssPath=${currentDir}/../../css_develop
optimizePath=${currentDir}
yui=/data0/shell/release_component/yuicompressor-2.4.8.jar

#创建临时目录
if [ ! -e ${distPath} ];then
    mkdir ${distPath}
fi

#build-circleHome.js
cp ${devPath}/app/mainConfigFile.js ${distPath}/mainConfigFile.js
sed -i -e 's/js_develop/js/g' ${distPath}/mainConfigFile.js
for srcf in ${optimizePath}/build-*.js;do
    if [ -f ${srcf} ];then
        filename=$(basename ${srcf})
        e=${#filename}
        e=$((e-3-6))
        filename=${filename:6:${e}}
        #echo "${filename} ${e}"
        echo "node ${devPath}/r.js -o ${srcf}"
        node ${optimizePath}/r.js -o ${srcf}
        cat ${distPath}/mainConfigFile.js ${devPath}/require.js ${distPath}/${filename}.js > ${distPath}/${filename}.combined.js
        if [ -f ${devCssPath}/${filename}.css ];then
            cat ${devCssPath}/${filename}.css > ${distPath}/${filename}.combined.css
            java -jar ${yui} ${distPath}/${filename}.combined.css -o ${distPath}/${filename}.min.css
        else
            cat ${devCssPath}/app.css > ${distPath}/app.combined.css
            java -jar ${yui} ${distPath}/app.combined.css -o ${distPath}/app.min.css
        fi
        java -jar ${yui} ${distPath}/${filename}.combined.js -o ${distPath}/${filename}.min.js
    fi
done

#拷贝压缩文件至发布目录，并拷贝若干文件至发布目录
cp -fr ${distPath}/*.min.js ${publishPath}/
cp -fr ${distPath}/*.min.css ${pubCssPath}/
#cp -fr ${devPath}/require.js ${publishPath}/
#cp -fr ${devPath}/app/mainConfigFile.js ${publishPath}/
#mkdir ${publishPath}/libs
#mkdir ${publishPath}/libs/zepto
#cp -fr ${devPath}/libs/zepto/zepto.js ${publishPath}/libs/zepto/zepto.js

#删除临时目录
rm -rf ${distPath}

#sed -i -e 's/js_develop/js/g' ${publishPath}/mainConfigFile.js