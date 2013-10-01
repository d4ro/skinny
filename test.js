/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


// mnożnik skoku
function f(x) {
    // zakres 300 - 1800 przekształcamy na 1 - 2
    x-=300; // 0 - 1500
    x/=750; // 0 - 1
    x+=1;   // 1 - 2
    var x2 = x*x; // 1 - 4
    return x2;
}

