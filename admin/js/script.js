// tinymce.init({
//   selector: 'textarea',  // note the comma at the end of the line!
//   plugins: 'code',
//   plugins: 'advlist', 
//   plugins: 'imagetools',
//   plugins: 'media, link,colorpicker,paste,table,textcolor',
//   browser_spellcheck: true,

//   // plugins: 'advlist',  // note the comma at the end of the line!
//   // toolbar: 'code',  // last reminder, note the comma!
 	
//    // plugins: 'advlist'
//   // code_dialog_height: 300,
//   // code_dialog_width: 350
//   // menubar: false,
//   // toolbar: 'bullist, numlist',
//    toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
//   // plugins: 'advlist',
//   advlist_bullet_styles: 'square',
//   advlist_number_styles: 'lower-alpha,lower-roman,upper-alpha,upper-roman'
// });



// example from the official site 
tinymce.init({
  // entity_encoding: "raw", // may be I use it to escape from SQL injection
  selector: 'textarea',
  height: 500,
  theme: 'modern',
  plugins: 'print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount   imagetools    contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });




