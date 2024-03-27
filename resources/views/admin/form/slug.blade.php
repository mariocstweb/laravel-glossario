<script>
    
    function getSlugTitle(){
        const titleForm = document.getElementById('title').value;
        
        const splitTitle = titleForm.split(' ');
        
        const slugTitle = splitTitle.join('-');
        
        return slugTitle
    }
    
    document.getElementById('title').addEventListener('change', function() {
        
        document.getElementById('slug').value = getSlugTitle();
    });

</script>