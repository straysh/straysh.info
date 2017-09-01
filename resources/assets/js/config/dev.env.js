let merge = require('webpack-merge');
const prodEnv = require('./prod.env');

const config = merge(prodEnv, {
  debug: true,
  host: 'http://www.straysh.local'
});

module.exports = config;
