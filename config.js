/**
 * Created by straysh / <jobhancao@gmail.com> on 17-9-1.
 */


const fs = require('fs');
const devEnv = require('./resources/assets/js/config/dev.env');
const prodEnv = require('./resources/assets/js/config/prod.env');

let config = process.env.NODE_ENV==='development' ? devEnv : prodEnv;

console.log(process.env.NODE_ENV, config);
config = "export default " + JSON.stringify(config, null, 2);
fs.writeFile('./resources/assets/js/config/index.js', config, 'utf8');