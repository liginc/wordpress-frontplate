'use strict';
const path = require('path');
const fs = require('fs-extra');
const Rx = require('rxjs');

module.exports = function (argv, config) {
  const randomStr = getRandomStr();
  const outputPath = `${config.anticache.dest}/anticache.json`;

  const json = {
    "anticache": randomStr
  };

  return Rx.Observable.create((observer) => {
    fs.outputFile(outputPath, JSON.stringify(json), err => {
      if(err) return observer.error(err);
    });
  });
};

function getRandomStr(len = 6){
  const str = '0123456789abcdefghijklmnopqrstuvwxyz';
  const parts = str.split('');
  const result = [];

  for(let i = 0; i < len; i++){
    const random = parseInt(Math.random() * parts.length);
    result[i] = parts[random];
  }

  return result.join('');
}
