const sharp = require('sharp');
const fs = require('fs');
const inputDir = './resources/img';
const outputDir = './public/assets/img';

fs.readdirSync(inputDir).forEach(file => {
    const input = `${inputDir}/${file}`;
    const output = `${outputDir}/${file}`;

    /* convert to webp */
    sharp(input)
        .toFormat('webp')
        .toFile(`${output}-full.webp`)

    /* convert to half size */
    sharp(input)
        .metadata()
        .then(({ width }) => sharp(input)
            .resize(Math.round(width * 0.5))
            .toFormat('webp')
            .toFile(`${output}-half.webp`)
        );

    /* third of the size */
    sharp(input)
        .metadata()
        .then(({ width }) => sharp(input)
            .resize(Math.round(width * 0.333))
            .toFormat('webp')
            .toFile(`${output}-third.webp`)
        );
});
