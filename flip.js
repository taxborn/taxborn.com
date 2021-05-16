const sharp = require('sharp');
const fs = require('fs');
const inputDir = './public/assets/img';

fs.readdirSync(inputDir).forEach(file => {
    const input = `${inputDir}/${file}`;

    /* convert to half size */
    sharp(input)
        .flip()
        .toFile(`${input}.webp`);
});
