//マイページのタブ切り替え
//要素を得る
let tabs = document.getElementById('tabcontrol').getElementsByTagName('a');
let pages = document.getElementById('tabbody').getElementsByClassName('tab');

//タブの切り替え処理
function changeTab() {
    //href属性値から対象のid名を抜き出す
    let targetid = this.href.substring(this.href.indexOf('#')+1,this.href.length);

    //指定のタブの内容を表示
    for (let i = 0; i < pages.length; i++) {
        if (pages[i].id != targetid) {
            pages[i].style.display = "none";
        } else {
            pages[i].style.display = "block";
        }        
    }

    //クリックされたタブを前面に表示
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].style.zIndex = "0";        
    }
    this.style.zIndex = "10";

    //ページ遷移しないようにfalseを返す
    return false;
}

//すべてのタブに対して、クリック時にchangeTab関数が実行されるようにする
for (let i = 0; i < tabs.length; i++) {
    tabs[i].onclick = changeTab;    
}

//最初は先頭のタブを選択しておく
tabs[0].onclick();


//削除確認
function delConf() {
    if (!confirm('削除しますか？')) {
        return false;
    }
}