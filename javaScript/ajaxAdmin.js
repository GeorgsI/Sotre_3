console.log(1);

if(document.querySelectorAll(".admin-dell-user")){
    
    const adminAellUser_btn = document.querySelectorAll(".admin-dell-user");
    for(let i = 0; i<adminAellUser_btn.length; i++){
        adminAellUser_btn[i].onclick = (e) => {
            
            
         let num = e.target.getAttribute('data-deluser');
         console.log(num);
            
 
            let idRow = {
                id:num
            };

            del(idRow , 'Core/deliaAdmin.php' ,'POST' );
        };    
    }
} 
    
    
  

if(document.querySelectorAll(".admin-update-user")){
    let updateFrame='';
 
    const adminAellUser_btnUpdate = document.querySelectorAll(".admin-update-user");
    for(let i = 0; i<adminAellUser_btnUpdate.length; i++){
        adminAellUser_btnUpdate[i].onclick = (e) => {
            
            let numUp = e.target.getAttribute('data-updateuser');

            updateFrame = document.createElement('div');  
            updateFrame.classList.add('updateWrepper');
            document.querySelector('.main').appendChild(updateFrame);
            /*document.querySelector('.updateWrepper').innerHTML = elemFormUpdate;*/
            
            
            
             
         

        //console.log(numUp);
            
 
            let idRow = {
                id:numUp 
            };

            del(idRow , 'Core/updateAdmin.php' ,'POST' );
        }; 
    }
}      
    
  





function  updateadmin(){  
    
            
 
            let idRow = {
                id:document.querySelector("#idUser").value,
                name:document.querySelector("#name").value,
                surname:document.querySelector("#surname").value,
                patronymic:document.querySelector("#patronymic").value,
                email:document.querySelector("#email").value
            };

            del(idRow , 'Core/insertAdmin.php' ,'POST' );
           

} 









    
    
    
    
    
    
function closeFormUpdate(){
          
        //let formbtnupdateUserClose = document.querySelector(".form-btn-updateUserClose");
       // formbtnupdateUserClose.onclick = () => {
        document.querySelector('.updateWrepper').remove();
  //  };        
       
}


    
    
 


 
//let elemFormUpdate = "<form  class='form formRegistration' id='formRegistrationUser'><div id='autherror'></div><div class='form-innerWrepper'>  <div class='form-elementWrepper'><h2 class='form-title'>Редактирование</h2></div><div class='form-elementWrepper'><input class='field formRegistration' placeholder='Имя' name='name' id='name' type='text'></div><div class='form-elementWrepper'><input class='field formRegistration' placeholder='Фамилия' name='surname'  id='surname' type='text'></div><div class='form-elementWrepper'><input class='field formRegistration' placeholder='Отчество' name='patronymic'  id='patronymic' type='text'></div><div class='form-elementWrepper'><input class='field formRegistration' placeholder='e-mail' name='email'  id='email' type='email'></div><div class='form-elementWrepper'><input class='field formRegistration' placeholder='адрес' name='address'  id='address' type='text'></div><div class='form-elementWrepper'><input class='btn form-btn formRegistration Registration-btn' type='button' value='Зарегистрироваться' title='Зарегистрироваться'></div><div class='form-elementWrepper' ><button  type='button' class='btn form-btn  form-btn-updateUserClose'  title='Назад'>Назад</button></div> </div></form>";
    
    
    
    
   
    
    
    
    
    
    
    
    
    
function del(data, responseFile, metod ){
    console.log(data);      
    sendRequestAdmin(data, responseFile, metod );   
}
    

    
function sendRequestAdmin(data, responseFile, metod)
{
    let xhr = new XMLHttpRequest();
    //данные формы
   
    
    //преобразуем их в JSON
    let requestJSON = JSON.stringify(data);
    console.log(typeof(requestJSON));
    
    
    xhr.open(metod, responseFile, true);
    //устанавливаем заголовок формата данных json
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = updateDocument; //имя функции обработки ответа сервера

    function updateDocument() {
        if (xhr.readyState === 4) { //проверяем статус завершения запроса - 4
            if (xhr.status === 200) { //проверяем код состояния 200 - OK
                let answerJSON = xhr.responseText;//ответ в JSON
                //парсим JSON, получаем аналог объекта PHP
                
                console.log(answerJSON);
                let answer = JSON.parse(answerJSON);
                if (answer.error) {
                    document.getElementById("autherror").innerHTML = answer.error + ": " + answer.message;
                    document.getElementById("auth").innerHTML ='';
                } 
                else if(answer.wrepperForm){
                     document.querySelector(".updateWrepper").innerHTML = answer.wrepperForm;
                }
                else {
                    document.getElementById("auth").innerHTML = answer.message;
                }
            }
        }
    }
    xhr.send(requestJSON); //посылаем данные методом POST
} 







    
    
    
    
    
    
    
    