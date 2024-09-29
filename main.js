const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

    if (bar){
        bar.addEventListener('click,'()=>{
            nav.classlist.add('active');
            
        })
    

)
if(close){
    close.addEventListener('click',()=>{
        nav.classlist.remove('active');

    })
}
//          function emailsend(){
    
//    Email.send({
//     Host : "smtp.elasticemail.com",
//     Username : "ajeet.thapa2005@gmail.com",
//     Password : "E1BBE45C86D55CF1C3235FD069C860A465B5",
//     To : 'ajeet.thapa2005@gmail.com',
//     From : "ajeet.thapa2005@gmail.com",
//     Subject : "This is the subject",
//     Body : "And this is the body"
// }).then(
//   message => alert(message)
// );
//     }
        
        
