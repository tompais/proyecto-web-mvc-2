var imagenes = JSON.parse($("#imgPrecargadas").val());

console.log(imagenes);

var precarga = [];

$.each(imagenes, function(index, value){
    precarga.push(pathImagenes + value);
});

console.log(precarga);

var upload = new FileUploadWithPreview('myFirstImage', {
    showDeleteButtonOnImages: true,
    text: {
        chooseFile: 'Ej: imagen.jpg',
        browse: 'Cargar',
        selectedCount: 'Imágenes cargadas',
    },
    presetFiles: precarga,
})