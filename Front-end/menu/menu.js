// var id_page = "<?php if(isset($_GET['page'])) { echo $_GET['page']; } else { echo 'all_menu_id li:first';} ?>";
var id_page = document.getElementsByName('id_page')[0].content;

if(document.querySelector("#"+id_page+"") != null)
{
    document.querySelector("#"+id_page+"").classList.add('active');
    document.querySelectorAll('.in').forEach(ele => {
        ele.classList.remove("in");
        ele.classList.remove("active");
    });
    document.querySelector("#"+id_page+"").parentNode.querySelectorAll('a').forEach(ele => {
    if(ele.parentNode.getAttribute('id') == id_page)
    {
        ele.setAttribute('aria-expanded' , true);
        ele.parentNode.parentNode.parentNode.querySelector("#"+id_page.split("_")[0]+"").classList.add("in");
        ele.parentNode.parentNode.parentNode.querySelector("#"+id_page.split("_")[0]+"").classList.add("active");
    }
    else
    {
        ele.setAttribute('aria-expanded' , false);
    }
    });
}