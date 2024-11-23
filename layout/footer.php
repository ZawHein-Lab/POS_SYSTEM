<script>
    let toggle_btn = $(".toggle-button");
    let toggle = $("#toggle");
    let sidebar = $(".sidebar");
    let deleteUser = $(".deleteUser");
    let deleteBtn = $("#deleteBtn");
    let closeBtn = $("#closeBtn");
   
    deleteUser.on("click",function(e){
        deleteKey = e.currentTarget.getAttribute("data-value");
        console.log(deleteKey);
    })

    deleteBtn.on("click",()=>{
        // console.log("Hello");
        location.replace("?deleteId="+deleteKey);
        closeBtn.click();
    })
    // $("#confirmDelete").on("click",()=>location.replace("?deleteId="+deleteKey));
     
    // for collapse
    let toggle_sidebar =$(".toggle-sidebar");
    let collapse = localStorage.getItem("collapse");
    // console.log(collapse);
    toggle_sidebar.on("click",function(){
       $(this).find("i.fa-angle-down").toggleClass("fa-angle-up");
    })
    if(collapse){
        toggle.addClass("fa-angle-right");
        sidebar.removeClass("extend");
    }else{
        toggle.addClass("fa-angle-left");
        sidebar.addClass("extend");
    }
    
    toggle_btn.on("click",()=>{
        toggle.toggleClass("fa-angle-right");
        sidebar.toggleClass("extend");
        btn_toggle_click();
    })
    btn_toggle_click= ()=>{
        let collapse =localStorage.getItem("collapse");
        if(collapse){
            localStorage.removeItem("collapse");
        }
        else{
            localStorage.setItem("collapse","clickBtn");
        }
    }
    
</script>
</body>
</html>