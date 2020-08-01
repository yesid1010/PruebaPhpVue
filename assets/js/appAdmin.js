var application2 = new Vue({
    el:'#appAdmin',
    data:{
        name:''
    },
    methods:{
        addCategory : function(name){
            axios.post('../backend/api.php',{
                url:'save_category',
                name:name
            })
            .then((data)=>{
                console.log(data.data);
            })
        }
    }

})