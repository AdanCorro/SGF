import { src, dest, watch, series, parallel} from 'gulp'; // src accede a los archivos fuente, dest a donde guardar, watch escucha cambios
import * as dartSass from 'sass'; // importamos el compilador sass
import gulpSass from 'gulp-sass'; // importamos el plugin gulp-sass que nos permite usar el compilador sass


const sass = gulpSass(dartSass); 

import terser from 'gulp-terser';

export function js(done){

    src('src/js/app.js')
        .pipe(terser())
        .pipe(dest('build/js'))

    done();
}

export function css(done) { // exportamos la funcion css
    src('src/scss/app.scss', {sourcemaps: true}) // accedemos a los archivos scss
        .pipe(sass({
            outputStyle: 'compressed', // indicamos que queremos que el archivo de salida sea de estilo compressado
        }).on('error', sass.logError)) // le pasamos el compilador sass
        .pipe(dest('build/css', {sourcemaps: '.'})) // le pasamos a donde guardar
                                // sourcemaps: true le indica que el archivo de mapeo de fuentes debe estar guardado en el directorio de destino
    done();
}


export function dev() {
    watch('src/scss/**/*.scss', css); // escuchamos cambios en los archivos scss
    watch('src/js/**/*.js', js); // escuchamos cambios en los archivos js
}

export default series(js, css, dev); // llamamos a las funciones exportadas y es improtanrte el orden en el cual se llaman