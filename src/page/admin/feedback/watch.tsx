import { FDate } from "../../../library/DateClass";
import { integ } from "../../../rocet/core/integration";
import './../../../CSS/component/watch.scss'

export function watch(watch:string|null , date_time:string, text_negative:string|null):JSX.Element{
    let JSX:Array<JSX.Element> = []

    function showmess(){
       let div = document.createElement('div')
       div.className = 'mess-modal'
        let divmes = document.createElement('div')
       divmes.textContent =text_negative;
       let  button =document.createElement('button')
       button.textContent = 'x'
       button.onclick = ()=>document.querySelector('.mess-modal').remove(); 
       divmes.append(button);
       div.append(divmes)
       document.querySelector('body').append(div)
    }
    if(watch){

       watch.split('//').forEach((taps:string)=>{
        let time = taps.split('--')[0].split(' ')[1]
        let date = taps.split('--')[0].split(' ')[0]
        let status = taps.split('--')[1].split(':')[0]
        let string = taps.split('--')[1].split(':')[1]
        if(status == 'CONNECT')
        JSX.push(<div className="icon dost" data={"Ссылка активирована "+ new FDate(date)['DD.MM.YYYY']()}><img src={require('./../../../images/mess.png')} /></div>)
        if(status == 'STAR'){
            JSX.push(<span/>)
            JSX.push(<div className="icon" data={"Поставил оценку "+ new FDate(date)['DD.MM.YYYY']() + " Время: "+ time}><p>{string}</p></div>)
        }

        if(status == "POSITIVE"){
             JSX.push(<span/>)
             JSX.push(<div className="icon icon-pl" data={"Перешел на платформу "+ string + " "+ new FDate(date)['DD.MM.YYYY']() + " Время: "+ time}><img src={require('./../../../images/search-'+string+'.png')} /></div>)
        }
       })
       
    }else{
        
        JSX.push(<div className="icon send" data={"Сообщение отправлено "+ new FDate(date_time.split(' ')[0])['DD.MM.YYYY']()}><img src={require('./../../../images/mess.png')} /></div>)
    }

    if(text_negative){
         JSX.push(<span/>)
         JSX.push(<div className="icon icon-pl" data={"Оставил  сообщение"} onclick={showmess}><img src={require('./../../../images/mess-text.png')} /></div>)
    }

    console.log(watch)
    return <div className="watch-path">
        {...JSX}
    </div>
}