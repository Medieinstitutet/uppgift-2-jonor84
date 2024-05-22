tinymce.init({
      selector: 'textarea#tiny',
	  language: 'sv_SE',
	  plugins: 'charmap image lists link anchor code emoticons media fullscreen',
      toolbar: 'fullscreen code undo redo removeformat | blocks | fontsize bold italic underline strikethrough align bullist numlist | link media image',
	  menubar: false,
	  // without images_upload_url set, Upload tab won't show up
      images_upload_url: 'core/tiny_upload.php',
      // override default upload handler to simulate successful upload
      images_upload_handler: 'image_upload_handler_callback',
	  convert_urls:false,
	  relative_urls:false,
 	  remove_script_host:false,
	  fullscreen_native: true,
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });

tinymce2.init({
  selector: 'textarea#tiny',
  skin: 'bootstrap',
  icons: 'bootstrap',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
  menubar: false,
  images_upload_url: 'tiny_postAcceptor.php',
  images_upload_credentials: true,
  images_upload_base_path: '/home/home/www/mylogin.nu/core/system/images/tiny',
  images_file_types: 'jpeg,jpg,jpe,jfi,jif,jfif,png,gif,bmp,webp',
  setup: (editor) => {
    editor.on('init', () => {
      editor.getContainer().style.transition='border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out';
    });
    editor.on('focus', () => {
      editor.getContainer().style.boxShadow='0 0 0 .2rem rgba(0, 123, 255, .25)';
      editor.getContainer().style.borderColor='#80bdff';
    });
    editor.on('blur', () => {
      editor.getContainer().style.boxShadow='';
      editor.getContainer().style.borderColor='';
    });
  }
});