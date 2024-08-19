class  Widgets
{

    contener = "widgets-rang"
    api = ""
    // host = "http://localhost:5555"
    host = "https://rang.altamedplus.ru"
    data;
    plaform = [];
    filial = [];
    header = true;

    constructor ()
    {
    }

    startKeys() {

       let filial = '?filial='

       this.filial.forEach((fil, i)=>{
        fil = fil.replace("+", "%2B");
        filial += this.filial.length - 1 == i ? fil : fil + ";";
       })

        this.get(this.host + "/widgets/" + this.api + filial).onload = (request) =>{
            const response = request.target.responseText
           let data = JSON.parse(response);
           this.build(data);
        }
    }

    // строим
    build(data){

       const widgetsElement = document.querySelector(this.contener);
        console.log(widgetsElement);
       //  задаем блок
       let block = this.createEl("div", 'blok-keys-widgets')

       widgetsElement.append(block)

       Object.keys(data).forEach((filial)=>{

           
           let blokcolumn = this.createEl("div", "block-colum");

           if(this.header){
               let h = this.createEl('h2');
                   h.textContent = filial;
                   blokcolumn.append(h);
           }

        let blockrow = this.createEl('div', 'block-row')
        
            Object.keys(data[filial]).forEach((plaform)=>{

                if(!this.excludePlatform(plaform)) return;

            const part = this.createEl('div');

               let star = this.createEl('p')
                   star.textContent = data[filial][plaform]['star']

               const img = this.createEl('img')
                     img.src = data[filial][plaform]['img']

                part.append(img, star)
                blockrow.append(part)
                
            })
            blokcolumn.append(blockrow)
            block.append(blokcolumn);
       })
    }



    // запросы 
     get(url) {
         const request = new XMLHttpRequest();
         request.open("GET", url, true);
         request.setRequestHeader("Content-type", "application/json");
         request.send();
         return request;
    }

    createEl(tag, className = ''){
        const el = document.createElement(tag)
        el.className = className
        return el;
    }

    excludePlatform(plaform){

        if(this.plaform.length != 0){

            return this.plaform.includes(plaform)
        }

        return true;
    }
}


//  let w = new Widgets();
//     w.api = '999-999-999'
//     w.filial = ['Альтамед+ на союзной']
//     w.plaform = [  ]
//     w.header = true
//     w.startKeys()
