$(function(){
    $('.input-file').each(function(){
        // Refs
        var $file = $(this),
            $label = $file.parent().prev('img'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();

        // When a new file is selected
        $file.on('change', function(event){
            var fileName = $file.val().split( '\\' ).pop(),
                tmppath = URL.createObjectURL(event.target.files[0]);
            //Check successfully selection
            if( fileName ){
                $label
                    .attr('src', tmppath);
                $labelText.text(fileName);
            }
        });

// End loop of file input elements
    });
})
