/* Imports */

document.writeln("<script type='text/javascript' src='https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script>");
document.writeln("<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/sweetalert2@11.4.14/dist/sweetalert2.all.min.js'></script>");
document.writeln("<script type='text/javascript' src='js/md5.js'></script>");

function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        //pageLanguage: 'en',
        includedLanguages: 'ro,en'
    }, 'google_translate_element');
    setTimeout(function() {
        var select = document.querySelector('select.goog-te-combo');
        select.dispatchEvent(new Event('change'));
    }, 1000)
}

/* End Imports*/

/* Header */
UserisLogged = isLogged();

headerHTML = document.querySelector("#headerHTML");
URLPage = window.location.pathname.substring(window.location.pathname.lastIndexOf('/')+1);
headerHTML.innerHTML = `
      <div class="container-fluid top no d-mobile-none">
         <div class="container row-center">
            <div class="row">
               <div class="col-md-4 col-12 user-login py-3 mt-md-3 mt-lg-4">

                  ${UserisLogged ? `
                  <a href="profile.html?id=${UserisLogged.id}">
                  <button type="button" class="btn">
                  <i class="fa fa-user"></i> ${UserisLogged.username}
                  </button>
                  </a>

                  <button type="button" class="btn logout-button">
                  <i class="fa fa-sign-out"></i> DECONECTEAZĂ-TE
                  </button>
                  ` : `
                  <a href="login.html">
                  <button type="button" class="btn">
                  <i class="fa fa-user"></i> LOGHEAZĂ-TE</button>
                  </a>`
               }

                  <div id="google_translate_element" style=""></div>
               </div>
               <div class="col-md-4 col-12 logo text-center py-3">
                  <a href="index.html"><img src="https://i.imgur.com/5KwhiY6.png" /></a>
               </div>
               <div class="col-md-4 top-utils text-right py-3 mt-md-3 mt-lg-4">
                  <div class="drop-search text-left">
                     <div class="row form-inline"> <!-- form -->
                        <input type="text" class="form-control" name="search-text" placeholder="Caută în site">
                        <button type="button" class="btn btn-search ml-2 search-button"><i class="fa fa-search"></i></button>
                     </div>
                  </div>
                  <div class="second-menu">
                     <div class="hamburger ripple ripple-radius" data-active="0">
                        <span class="icon-menu" style="font-size: 32px"><i class="fa fa-bars"></i></span>
                     </div>
                     <div class="side-menu">
                        <div class="second-menu-links">
                           <img class="menu-sigla" src="https://i.imgur.com/Lh10eXb.png">
                           <h6><a href="index.html">Acasă</a></h6>
                           <h6><a href="desprenoi.html">Despre Noi</a></h6>
                           <h6><a href="contact.html">Contact</a></h6>
                        </div>
                        <div class="second-menu-footer">
                           <p><a href="#">vartic2003@gmail.com</a> </p>
                           <p><a href="tel:#">0124131</a> </p>
                           <p class="socials-black">
                              <a href="#" target="_blank" title="Facebook"><i class="icon icon-facebook"></i></a>                                <a href="#"  target="_blank" title="Twitter"><i class="icon icon-twitter"></i></a>                                 <a href="#"  target="_blank" title="Instagram"><i class="icon icon-instagram"></i></a>                            
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid no menu-bg d-mobile-none">
         <div class="container row-center">
            <div class="row">
               <div class="col-12">
                  <nav class="navbar navbar-expand-md">
                     <a class="navbar-brand d-md-none" href="index.html"><img src="https://i.imgur.com/5KwhiY6.png"></a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     <span class="navbar-toggler-icon"></span>
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto ml-0">
                           <li class="nav-item ${URLPage == "index.html" ? "active" : false}"><a class="nav-link" href="index.html"><span>ACASĂ</a></span></li>
                           <li class="nav-item ${URLPage == "categorii.html" ? "active" : false}"><a class="nav-link" href="categorii.html"><span>CATEGORII</a></span></li>
                           <li class="nav-item ${URLPage == "achitare.html" ? "active" : false}"><a class="nav-link" href="achitare.html"><span>ACHITARE</a></span></li>
                           <li class="nav-item ${URLPage == "desprenoi.html" ? "active" : false}"><a class="nav-link" href="desprenoi.html"><span>DESPRE NOI</a></span></li>
                           <li class="nav-item ${URLPage == "contact.html" ? "active" : false}"><a class="nav-link" href="contact.html"><span>CONTACT</a></span></li>
                           ${UserisLogged && UserisLogged.admin ? `
                              <li class="nav-item ${URLPage == "admin.html" ? "active" : false}"><a class="nav-link" href="admin.html"><span>ADMIN</a></span></li>
                           ` : ""}
                        </ul>
                        <div class="menu-cart">
                           <div class="dropdown drop-cart ">
                              <a class="drop-link cart-open-small" href="cos.html" role="button" id="dropdownMenuLink" >
                              <small class="cart-number-new"></small>
                              <i class="fa fa-shopping-basket"></i> <span id="headerCountCos"></span>
                              </a>
                           </div>
                           <a class="top-utlis-link" href="wishlist.html" title="Favorite"> <i class="fa fa-heart"></i> <span id="headerCountWishlist"></a>
                        </div>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid top-mobile fixed-top d-md-none">
         <div class="container row-center">
            <div class="row">
               <div class="col-sm-7 col-5 no logo-mobile">
                  <a href="index.html"><img src="https://i.imgur.com/5KwhiY6.png"/></a>
               </div>
               <div class="col-sm-5 col-7 no top-utils-mobile text-right ">
                  <div class="menu-cart">
                     <div class="dropdown drop-cart ">
                        <a class="drop-link cart-open-small" href="cos.html" role="button" id="dropdownMenuLink" >
                        <small class="cart-number-new"></small>
                        <i class="fa fa-shopping-basket"></i> <span id="headerCountCos"></span>
                        </a>
                     </div>
                     <div class="dropdown drop-user cont-open-small ">
                        <a class="drop-link" href="login.html" role="button" id="dropdownMenuLink" >
                        <i class="fa fa-user"></i>
                        </a>
                     </div>
                     <a class="top-utlis-link " href="#" title="Whishlist"> <i class="fa fa-heart"></i> <span id="headerCountWishlist"></span></a>
                  </div>
                  <div class="menu-mobile ">
                     <div class="hamburger-two ripple ripple-radius" data-active="0">
                        <span class="icon-menu-two"><i class="fa fa-bars"></i></span>
                     </div>
                     <div class="side-menu-two">
                        <div class="collapse-submenu">
                           <h5><a href="index.html">
                              Acasă
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="categorii.html">
                              Categorii
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="achitare.html">
                              Achitare
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="desprenoi.html">
                              Despre Noi
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           <h5><a href="contact.html">
                              Contact
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>
                           ${UserisLogged && UserisLogged.admin ? `
                              <h5><a href="admin.html">
                              Admin
                              <button class="btn submenu-collapse"><i class="fa fa-eye"></i></button>
                              </a>
                           </h5>` : ""}
                        </div>
                        <div class="side-second-menu">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row text-center"> <!-- form -->
               <div class="col-md-12 no text-center pb-2">
                  <button type="button" class="btn btn-search srcbtnx search-button"><i class="fa fa-search"></i></button>
                  <input type="text" class="form-control" name="search-text" placeholder="Caută în site">
               </div>
            </div>
         </div>
      </div>
`;


var meniu = document.querySelector(".hamburger");
var meniumare = document.querySelector(".hamburger-two");

function setMeniu(classname, iconmenu) {
    var activat = meniu.getAttribute('data-active');
    let barsopacity = document.querySelector(".bars-opacity");
    if (activat == 0 || activat == undefined) {
        if (barsopacity != null) barsopacity.style.opacity = "0.2";
        classname.style.display = "block";
        meniu.dataset.active = 1;
        iconmenu.innerHTML = "<i class='fa fa-times'></i>";
    }
    if (activat == 1) {
        if (barsopacity != null) barsopacity.style.opacity = "1";
        classname.style.display = "none";
        meniu.dataset.active = 0;
        iconmenu.innerHTML = "<i class='fa fa-bars'></i>";
    }
}

meniu.onclick = function() {
    setMeniu(document.querySelector(".side-menu"), document.querySelector(".icon-menu"));
};
meniumare.onclick = function() {
    setMeniu(document.querySelector(".side-menu-two"), document.querySelector(".icon-menu-two"));
};


let cos_array = localStorage.getItem("cos_array");
if (cos_array && cos_array.length) {
    cos_array = JSON.parse(cos_array);
    let headerCountCos = document.querySelectorAll("#headerCountCos");
    headerCountCos.forEach((item) => {
        if (cos_array.length > 0) item.innerHTML = cos_array.length;
    });
} else cos_array = [];

let wish_array = localStorage.getItem("wishlist_array");
if (wish_array && wish_array.length) {
    wish_array = JSON.parse(wish_array);
    let headerCountWishlist = document.querySelectorAll("#headerCountWishlist");
    headerCountWishlist.forEach((item) => {
        if (wish_array.length > 0) item.innerHTML = wish_array.length;
    });
} else wish_array = [];

if (UserisLogged) {
   logoutButton = document.querySelector(".logout-button");
   logoutButton.addEventListener('click', () => {
      localStorage.removeItem("isLogged");
      alert("Te-ai delogat cu succes de pe website!");
      window.location.replace("index.html");
   });
}
/* End Header */


/* Footer */
footerHTML = document.querySelector("#footerHTML");
footerHTML.innerHTML = `
      <div class="container-fluid no parallax-bg" style="background-image:url(https://i.imgur.com/5hTJzyEh.jpg);">
         <div class="container-fluid no bg-overlay">
            <div class="container">
               <div class="row pt-2 pb-4">
                  <div class="col-12 text-center scrollpoz">
                     <img class="parallax-logo" src="https://i.imgur.com/3DeHjIZ.png">
                     <h2>De ce să ne alegi pe noi?</h2>
                     <p>Utilajele, echipamentele și tehnologiile sunt de ultimă generație, împreună cu specialiștii noștri și managerii profesioniști. Spectru complex al analizelor medicale cu rezultate disponibile în cel mai scurt timp.</p>
                     <a class="btn btn-default mt-4" href="desprenoi.html">Vezi detalii despre noi</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid no border-top py-4">
         <div class="container row-center">
            <div class="row">
               <div class="col-sm-4 col-12 section-info text-center py-3 ">
                  <img src="https://i.imgur.com/Ft6TF92.png"/>
                  <h5>Calitate</h5>
                  <p>Vă promitem cea mai înaltă calitate.</p>
               </div>
               <div class="col-sm-4 col-12 section-info text-center py-3 ">
                  <img src="https://i.imgur.com/ach9FwJ.png"/>
                  <h5>Drept de retur</h5>
                  <p>Returnare bani dacă nu vă mulțumesc serviciile.</p>
               </div>
               <div class="col-sm-4 col-12 section-info text-center py-3 ">
                  <img src="https://i.imgur.com/e2qOyxe.png"/>
                  <h5>Modalități de plata</h5>
                  <p>Acceptăm plata cash, dar și plata cu cardul.</p>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid no bg-light newsl-bg">
         <div class="container row-center">
            <div class="row py-4 pb-2">
               <div class="col-md-6 text-md-left pt-4 pb-2">
                  <h4>Contactează-ne!</h4>
                  <p>Lasă-ne numărul de telefon și email-ul, iar noi te vom suna!</p>
               </div>
               <div class="col-md-6 text-md-left pt-4 pb-2">
                  <div class="row">
                     <div class="col-md-4">
                        <input type="text" class="form-control emailfooter" placeholder="Nr. Telefon"/>
                     </div>
                     <div class="col-md-4">
                        <input type="text" class="form-control telfooter" placeholder="Adresa de e-mail"/>
                     </div>
                     <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block btn-contactfooter">Trimite</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid no mini-footer">
         <div class="container row-center">
            <div class="row pt-2 pb-1">
               <div class="col-md-9 text-center text-md-left">
                  <p>Copyright BeautyHealth. Toate drepturile rezervate.</p>
               </div>
               <div class="col-md-3 text-center text-md-right">
                  <p><a href="#" target="_blank">Developed by Vartic Vasile</a> </p>
               </div>
            </div>
         </div>
      </div>
`;
contactFooter = document.querySelector(".btn-contactfooter");
contactFooter.addEventListener('click', () => {
   emailFooter = document.querySelector(".emailfooter");
   telFooter = document.querySelector(".telfooter");
   if (!emailFooter.value || !telFooter.value) fire("error", "Nu ai scris numărul de telefon sau e-mail-ul!"); else {
      emailFooter.value = "";
      telFooter.value = "";
      fire("success", "Mulțumim, în cateva ore echipa noastră te va contacta!"); 
   }
});
/* End Footer */

function addCartRender() {
    var add_cart = document.querySelectorAll(".jsaddcart");

    add_cart.forEach((cart) => {
      cart.addEventListener('click', () => {
            cart_array = [];
            cart_finalarray = localStorage.getItem("cos_array");
            if (cart_finalarray) cart_finalarray = JSON.parse(cart_finalarray); else cart_finalarray = [];

            let id = cart.getAttribute("data-id");
            let name = cart.getAttribute("data-name");
            let price = cart.getAttribute("data-price");
            let image = cart.getAttribute("data-image");
            let view_service = cart.getAttribute("data-viewservice");    

            if (view_service == 1) {
                let cant = document.querySelector("[name='service_cant']")
                amount = cant.value;
            } else {
                amount = cart.getAttribute("data-amount");
            }

            exist = 0;
            alertAmount = amount;

            if (cart_finalarray && cart_finalarray.length) {
                cart_finalarray.forEach((item, index) => {
                    if (item.id == id) {
                        exist = 1;
                        amount = parseInt(item.amount) + parseInt(amount);
                        cart_finalarray.splice(index, 1);
                    }
                });
            }

            cart_array = {id, name, price, amount, image};
            cart_finalarray.push(cart_array);

            let headerCountCos = document.querySelectorAll("#headerCountCos");
            headerCountCos.forEach((item) => {
                if (cart_finalarray.length > 0) item.innerHTML = cart_finalarray.length;
            });

            localStorage.setItem("cos_array", JSON.stringify(cart_finalarray));

            window.scrollTo({ top: 0, behavior: 'smooth' });

            if (exist == 0) toast("success", `Serviciul '${name}' a fost adăugat în Coș!`);
            else toast("info", `Serviciului '${name}' i s-a adăugat ${alertAmount} cantitate, deoarece o ai deja în coș!`);
      });
    });
}

function addWishListRender() {
    let add_wishlist = document.querySelectorAll(".jsaddwishlist");

    add_wishlist.forEach((item) => {
      item.addEventListener('click', () => {
            let wishlist_array = [];
            let wishlist_finalarray = localStorage.getItem("wishlist_array");
            if (wishlist_finalarray) wishlist_finalarray = JSON.parse(wishlist_finalarray); else wishlist_finalarray = [];

            let id = item.getAttribute("data-id");
            let name = item.getAttribute("data-name");
            let price = item.getAttribute("data-price");
            let stars = item.getAttribute("data-stars");
            let image = item.getAttribute("data-image");

            let existw = 0;

            if (wishlist_finalarray && wishlist_finalarray.length) {
                wishlist_finalarray.forEach((item, index) => {
                    if (item.id == id) {
                        existw = 1;
                    }
                });
            }

            if (existw == 0) {
                wishlist_array = {id, name, price, stars, image};
                wishlist_finalarray.push(wishlist_array);
                toast("success", `Serviciul '${name}' a fost adăugat în Wishlist!`);
            } else {
                toast("error", `Serviciul '${name}' este deja în Wishlist!`);
            }

            localStorage.setItem("wishlist_array", JSON.stringify(wishlist_finalarray));

            let headerCountWishlist = document.querySelectorAll("#headerCountWishlist");
            headerCountWishlist.forEach((item) => {
                if (wishlist_finalarray.length > 0) item.innerHTML = wishlist_finalarray.length;
            });

            window.scrollTo({ top: 0, behavior: 'smooth' });

            console.log(wishlist_finalarray);
      });
    });
}

// addCartRender();
// addWishListRender();

function pageWishlist() {
     var array = localStorage.getItem("wishlist_array");
     array = JSON.parse(array);

     console.log(array);

     var htmlWishlist = document.querySelector("#WishlistHTML");

     let html = "";

     if (array) {
         array.forEach((item) => {
            let htmlStars = "";
            for(let i=1; i <= item.stars; i++) {
                htmlStars += `<i class="fa fa-star"></i>`;
            }
            html += `
                <div class="col-md-3 card prod-item mb-2" id="wishcard_${item.id}">
                   <figure>
                      <div class="add-whis">
                         <i class="fa fa-times remove_wishservice" data-id="${item.id}"></i>
                      </div>
                      <div class="add-cart jsaddcart" data-id="${item.id}" data-amount="1" data-name="${item.name}" data-price="${item.price}" data-image="${item.image}">
                         <i class="fa fa-shopping-basket"></i>
                      </div>
                      <a href="serviciu.html?id=${item.id}">
                      <img src="${item.image}">
                      </a>
                   </figure>
                   <div class="prod-item-info">
                      <h3>
                         <a href="serviciu.html?id=${item.id}">${item.name}</a>
                      </h3>
                      <h4 class="prod-price">${item.price} MDL</h4>
                      <div class="star-item-single">${htmlStars}</div>
                   </div>
                </div>
                <div class="col-md-1" id="wishcardtwo_${item.id}"></div>
            `;
         });        
     }

     if (array && array.length) {
        htmlWishlist.innerHTML = html;
    }
     else htmlWishlist.innerHTML = `Nu sunt servicii adăugate în favorite!`;

    addCartRender();

    remove_wishservice = document.querySelectorAll(".remove_wishservice");

    remove_wishservice.forEach((item) => {
        item.addEventListener('click', () => {
            id = item.getAttribute("data-id");
            if (array && array.length) {
                array.forEach((item, index) => {
                    if (item.id == id) {
                        array.splice(index, 1);
                        localStorage.setItem("wishlist_array", JSON.stringify(array));
                    }
                });
                card_remove = document.querySelector(`#wishcard_${id}`).remove();
                card_remove_two = document.querySelector(`#wishcardtwo_${id}`).remove();

               let headerCountWishlist = document.querySelectorAll("#headerCountWishlist");
               headerCountWishlist.forEach((item) => {
                if (array.length > 0) item.innerHTML = array.length; else item.innerHTML = "";
               });
            }

            if (!array || !array.length) {
                htmlWishlist.innerHTML = `Nu sunt servicii adăugate în favorite!`;
            };
        });
    });  
}

function pageCos() {
     var array = localStorage.getItem("cos_array");
     array = JSON.parse(array);

     var htmlCos = document.querySelector("#CosHTML");
     nrServicii = document.querySelector("#nrServicii");
     totalPrice = document.querySelector("#totalPrice");
     countPrice = 0;

     let html = "";

     if (array) {
         array.forEach((item) => {
            serviciuCountTotalPrice = item.price * item.amount;
            html += `
                <div class="card pb-4" id="card_${item.id}">
                   <div class="row">
                      <div class="col-md-4">
                         <figure>
                            <a class="prod-img-new" href="serviciu.html?id=${item.id}"><img src="${item.image}"></a>
                         </figure>
                      </div>
                      <div class="col-md-8">
                         <h3><a href="serviciu.html?id=${item.id}">${item.name}</a></h3>
                         <h4 class="prod-price">Preț: ${item.price} MDL</h4>
                         <div class="prod-quant text-center">
                            <div class="input-group mt-1 mb-2">
                               <span class="input-group-btn">
                               <button type="button" class="btn btn-number remove_cant" data-id="${item.id}" data-price="${item.price}">
                               <span class="fa fa-minus"></span>
                               </button>
                               </span>
                               <input type="number" value="${item.amount}" min="1" max="1000" class="form-control" id="nr_cant_${item.id}" disabled>
                               <span class="input-group-btn">
                               <button type="button" class="btn btn-number add_cant" data-price="${item.price}" data-id="${item.id}">
                               <span class="fa fa-plus"></span>
                               </button>
                               </span>
                            </div>
                         </div>
                         <h4 class="prod-price">Total: <span id="serviciuTotalPrice_${item.id}">${serviciuCountTotalPrice}</span> MDL</h4>
                         <span class="float-right remove_service" data-id="${item.id}"><button class="btn btn-danger"><i class="fa fa-remove"></i></button></span>
                      </div>
                   </div>
                </div>
                <br>
            `;
            countPrice += parseFloat(item.price * item.amount);
         });
     }

     totalPrice.innerHTML = countPrice;

     if (array && array.length) {
        htmlCos.innerHTML = html;
        nrServicii.innerHTML = array.length;
    }
     else htmlCos.innerHTML = `
       <div class="card pb-4">
          Nu sunt servicii adăugate în Coș!
       </div>
    `;

    add_cant = document.querySelectorAll(".add_cant");
    remove_cant = document.querySelectorAll(".remove_cant");

    add_cant.forEach((cant) => {
        cant.addEventListener('click', () => {
            id = cant.getAttribute("data-id");
            price = cant.getAttribute("data-price");
            nr_cant = document.querySelector(`#nr_cant_${id}`);
            nr_cant.value++;
            countPrice += parseFloat(price);
            totalPrice.innerHTML = countPrice;

            serviciuTotalPrice = document.querySelector(`#serviciuTotalPrice_${id}`);
            serviciuCountPrice = parseFloat(serviciuTotalPrice.innerText);
            serviciuCountPrice += parseFloat(price);
            serviciuTotalPrice.innerHTML = serviciuCountPrice;
        });
    });

    remove_cant.forEach((cant) => {
        cant.addEventListener('click', () => {
            id = cant.getAttribute("data-id");
            price = cant.getAttribute("data-price");
            nr_cant = document.querySelector(`#nr_cant_${id}`);
            console.log(nr_cant);
            if (nr_cant.value > 1) {
                nr_cant.value--;
                countPrice -= parseFloat(price);
                totalPrice.innerHTML = countPrice;

                serviciuTotalPrice = document.querySelector(`#serviciuTotalPrice_${id}`);
                serviciuCountPrice = parseFloat(serviciuTotalPrice.innerText);
                serviciuCountPrice -= parseFloat(price);
                serviciuTotalPrice.innerHTML = serviciuCountPrice;
            }
        });
    });

    remove_service = document.querySelectorAll(".remove_service");

    remove_service.forEach((item) => {
        item.addEventListener('click', () => {
            id = item.getAttribute("data-id");
            if (array && array.length) {
                array.forEach((item, index) => {
                    if (item.id == id) {
                        cant = document.querySelector(`#nr_cant_${item.id}`);
                        minusPrice = parseFloat(cant.value) * item.price;
                        totalPrice.innerHTML = parseFloat(totalPrice.innerText) - minusPrice;
                        array.splice(index, 1);
                        localStorage.setItem("cos_array", JSON.stringify(array));
                        nrServicii.innerHTML = array.length;
                    }
                });
                card_remove = document.querySelector(`#card_${id}`).remove();

               let headerCountCos = document.querySelectorAll("#headerCountCos");
               headerCountCos.forEach((item) => {
                if (array.length > 0) item.innerHTML = array.length; else item.innerHTML = "";
               });
            }

            if (!array || !array.length) {
                htmlCos.innerHTML = `
                   <div class="card pb-4">
                      Nu sunt servicii adăugate în Coș!
                   </div>
                `;
            };
        });
    });   
}

function finalizareComandaCos() {
    array = localStorage.getItem("cos_array");
    array = JSON.parse(array);

    if (array && array.length) {
        sarray = JSON.parse(localStorage.getItem("services_array"));
        if (sarray && sarray.length) {
            array.forEach((aitem, aindex) => {    
                sarray.forEach((sitem, sindex) => {
                    if (aitem.id == sitem.id) {
                        nr_cant = document.querySelector(`#nr_cant_${aitem.id}`);
                        sarray[sindex].selled = parseInt(sitem.selled) + parseInt(nr_cant.value);
                    }
                });
            });
        }
        localStorage.setItem("services_array", JSON.stringify(sarray));

        htmlCos = document.querySelector("#CosHTML");
        htmlCos.innerHTML = `
           <div class="card pb-4">
              Nu sunt servicii adăugate în Coș!
           </div>
        `;
        nrServicii = document.querySelector("#nrServicii");
        totalPrice = document.querySelector("#totalPrice");
        fire("success", `Ai finalizat comanda cu succes, ai cumpărat ${nrServicii.innerText} servicii pentru ${totalPrice.innerText} MDL!`)

        localStorage.removeItem("cos_array");

        let headerCountCos = document.querySelectorAll("#headerCountCos");
        headerCountCos.forEach((item) => {
            item.innerHTML = "";
        });

        nrServicii.innerHTML = 0;
        totalPrice.innerHTML = 0;
    } else toast("error", "Nu sunt servicii adăugate în Coș!");
}

function viewServicePage() {
    idService = window.location.search;
    idParams = new URLSearchParams(idService).get('id');
    displayService = document.querySelector("#displayService");

    item = undefined;
    array = JSON.parse(localStorage.getItem("services_array"));
    if (idParams) item = array.find(element => element.id == idParams);

    if (item == undefined) {
        alert("Nu există nici un serviciu cu acest ID!");
        window.location.replace("404.html");
        throw new Error("Nu există nici un serviciu cu acest ID!");
    }

    displayService.innerHTML = `
        <div class="col-md-5">
           <div class="item px-2">
              <figure>
                 <a href="#"><img src="${item.image}"></a>
              </figure>
           </div>
        </div>
        <div class="col-md-7 prod-page">
           <div class="row">
              <div class="col-md-12">
                 <h1>${item.name}</h1>
                 <h4 class="prod-code">Cod produs: ${item.id}
                 <button class="btn float-right delete-service" data-id="${item.id}" data-name="${item.name}">Șterge</button></h4>
              </div>
              <div class="col-md-12 prod-price text-center">
                 <h2>${item.price} MDL</h2>
                 <label class="stoc-label text-success">În stoc</label>
                 <label>Prețul include TVA</label>
                 <label>Achitare: numerar / card</label>                            
              </div>
              <div class="col-md-12 pt-4 text-center">
                 <div class="row">
                    <div class="col-md-6 prod-quant">
                       <div class="input-group mt-1 mb-2">
                          <span class="input-group-btn">
                          <button type="button" class="btn btn-number remove_cant" data-id="${item.id}" data-price="${item.price}">
                          <span class="fa fa-minus"></span>
                          </button>
                          </span>
                          <input id="nr_cant_${item.id}" type="number" name="service_cant" class="form-control" value="1" disabled>
                          <span class="input-group-btn">
                          <button type="button" class="btn btn-number add_cant" data-id="${item.id}" data-price="${item.price}">
                          <span class="fa fa-plus"></span>
                          </button>
                          </span>
                       </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                       <button class="btn btn-danger jsaddcart" type="button" data-viewservice="1" data-id="${item.id}" data-amount="${item.amount}" data-name="${item.name}" data-price="${item.price}" data-image="${item.image}">Adaugă în coș</button>
                    </div>
                 </div>
                 <h3 class="text-center">Total preț: <span id="serviciuTotalPrice_${item.id}">${item.price}</span> MDL</h3>
              </div>
           </div>
        </div>
        <div class="col-md-12 page-content">
           <h3>Descriere</h3>
           <p>${item.description}</p>
        </div>
    `;

    add_cant = document.querySelector(".add_cant");
    remove_cant = document.querySelector(".remove_cant");
    delete_service = document.querySelector(".delete-service");

    add_cant.addEventListener('click', () => {
        id = add_cant.getAttribute("data-id");
        price = add_cant.getAttribute("data-price");
        nr_cant = document.querySelector(`#nr_cant_${id}`);
        nr_cant.value++;
        serviciuTotalPrice = document.querySelector(`#serviciuTotalPrice_${id}`);
        serviciuCountPrice = parseFloat(serviciuTotalPrice.innerText);
        serviciuCountPrice += parseFloat(price);
        serviciuTotalPrice.innerHTML = serviciuCountPrice;
    });

    remove_cant.addEventListener('click', () => {
        id = add_cant.getAttribute("data-id");
        price = add_cant.getAttribute("data-price");
        nr_cant = document.querySelector(`#nr_cant_${id}`);
        if (nr_cant.value > 1) {
            nr_cant.value--;
            serviciuTotalPrice = document.querySelector(`#serviciuTotalPrice_${id}`);
            serviciuCountPrice = parseFloat(serviciuTotalPrice.innerText);
            serviciuCountPrice -= parseFloat(price);
            serviciuTotalPrice.innerHTML = serviciuCountPrice;
        }
    });
    addCartRender();

    delete_service.addEventListener('click', () => {
        id = delete_service.getAttribute("data-id");
        name = delete_service.getAttribute("data-name");
        array.forEach((item, index) => {
         if (item.id == id) array.splice(index, 1);
        });
        localStorage.setItem("services_array", JSON.stringify(array));
        alert(`Serviciul '${name}' a fost șters cu succes!`);
        window.location.replace("categorii.html");
    });
}

function viewProfilePage() {
    idAccount = new URLSearchParams(window.location.search).get('id');
    displayProfile = document.querySelector("#displayProfile");

    item = undefined;
    array = localStorage.getItem("accounts_array");
    if (array) array = JSON.parse(array); else array = [];

    if (idAccount && array) item = array.find(element => element.id == idAccount);

    if (item == undefined) {
        alert("Nu există nici un cont cu acest ID!");
        window.location.replace("404.html");
        throw new Error("Nu există nici un cont cu acest ID!");
    }

    displayProfile.innerHTML = `
        <div class="col-md-5">
           <div class="item px-2">
              <figure>
                 <a href="#"><img src="${item.image}"></a>
              </figure>
           </div>
        </div>
        <div class="col-md-7 prod-page">
           <div class="row">
              <div class="col-md-12">
                 <h1>
                 Profilul lui <span style="text-transform: capitalize;">${item.username}</span>
                 ${UserisLogged.admin ? `<button class="btn float-right delete-account" data-id="${item.id}" data-username="${item.username}">Șterge</button>` : ``}
                 </h1><br>
                 <h3 class="col-md-12" style="color: #A8A8A8; font-weight: 500; font-size: 17px">
                 ID <span class="float-right">${item.id}</span>
                 <br>E-Mail <span class="float-right">${item.email}</span>
                 <br>Administrator <span class="float-right">${item.admin > 0 ? "da" : "nu"}</span>
                 <br>Data creării contului <span class="float-right">${item.date}</span>
                 </h3>
              </div>
           </div>
        </div>
    `;

    delete_account = document.querySelector(".delete-account");

delete_account.addEventListener('click', () => {
if (!UserisLogged.admin) {
   fire("error", "Nu ai acces să ștergi contul, deoarece nu ești Administrator!");
} else {
   id = delete_account.getAttribute("data-id");
   username = delete_account.getAttribute("data-username");
   array.forEach((item, index) => {
   if (item.id == id) array.splice(index, 1);
});
localStorage.setItem("accounts_array", JSON.stringify(array));
alert(`Contul lui '${username}' a fost șters cu succes!`);
window.location.replace("index.html");
}
});
}

function servicesPage() {
    array = localStorage.getItem("services_array");
    if (array) array = JSON.parse(array); else array = [];

    displayServices = document.querySelector("#displayServices");
    html = "";

    typeService = window.location.search;
    typeParams = new URLSearchParams(typeService).get('type');
    typeError = "";

    if (typeParams != "sanatate" && typeParams != "infrumusetare" && typeParams != "altele" && typeParams != "toate") typeError = "URL invalid, nu ai întrodus [?type] corect!!";
    if (!typeParams) typeError = "URL invalid, nu ai întrodus [?type]!";

    if (typeError) {
        alert(typeError);
        window.location.replace("404.html");
        throw new Error(typeError);
    }

    if (typeParams == "sanatate" || typeParams == "infrumusetare" || typeParams == "altele")
        array = array.filter(element => element.type.includes(typeParams));

    if (array && array.length) {

        array.forEach((item, index) => {

            let htmlStars = "";
            for(let i=1; i <= item.stars; i++) {
                htmlStars += `<i class="fa fa-star"></i>`;
            }

            html += `
                <div class="col-md-3 prod-item small-prod pb-4">
                   <figure>
                      <div class="add-whis jsaddwishlist" data-id="${item.id}" data-name="${item.name}" data-price="${item.price}" data-stars="${item.stars}" data-image="${item.image}">
                         <i class="fa fa-heart"></i>
                      </div>
                      <div class="add-cart jsaddcart" data-id="${item.id}" data-amount="${item.amount}" data-name="${item.name}" data-price="${item.price}" data-image="${item.image}">
                         <i class="fa fa-shopping-basket"></i>
                      </div>
                      <a href="serviciu.html?id=${item.id}">
                      <img src="${item.image}">
                      </a>
                   </figure>
                   <center><small>tip: ${item.type}</small></center>
                   <h3>
                      <a href="serviciu.html?id=${item.id}">${item.name}</a>
                   </h3>
                   <div class="prod-price">
                      <h4 class="prod-price">${item.price} MDL</h4>
                      <div class="star-item-single">${htmlStars}
                      <br><small>${item.selled} cantități cumpărate</small></div>
                   </div>
                </div>
            `;
        });

    } else {
        html = "<div class='card col-md-12 mb-4'>Nu sunt servicii disponibile pe site!</div>";
    }

    displayServices.innerHTML = html;

    addCartRender();
    addWishListRender();
}

function priceOrderServicesPage() {
    priceOrder = document.querySelector(".getPriceOrder").value;

    array = localStorage.getItem("services_array");
    if (array) array = JSON.parse(array); else array = [];

    displayServices = document.querySelector("#displayServices");
    html = "";

    typeService = window.location.search;
    typeParams = new URLSearchParams(typeService).get('type');

    if (typeParams == "sanatate" || typeParams == "infrumusetare" || typeParams == "altele")
        array = array.filter(element => element.type.includes(typeParams));

    if (array && array.length) {

        if (priceOrder == "Ascendent") {
            array.sort(function (x, y) {
                return x.price - y.price;
            });
        }

        if (priceOrder == "Descendent") {
            array.sort(function (x, y) {
                return y.price - x.price;
            });
        }

        array.forEach((item) => {

            let htmlStars = "";
            for(let i=1; i <= item.stars; i++) {
                htmlStars += `<i class="fa fa-star"></i>`;
            }

            html += `
                <div class="col-md-3 prod-item small-prod pb-4">
                   <figure>
                      <div class="add-whis jsaddwishlist" data-id="${item.id}" data-name="${item.name}" data-price="${item.price}" data-stars="${item.stars}" data-image="${item.image}">
                         <i class="fa fa-heart"></i>
                      </div>
                      <div class="add-cart jsaddcart" data-id="${item.id}" data-amount="${item.amount}" data-name="${item.name}" data-price="${item.price}" data-image="${item.image}">
                         <i class="fa fa-shopping-basket"></i>
                      </div>
                      <a href="serviciu.html?id=${item.id}">
                      <img src="${item.image}">
                      </a>
                   </figure>
                   <center><small>tip: ${item.type}</small></center>
                   <h3>
                      <a href="serviciu.html?id=${item.id}">${item.name}</a>
                   </h3>
                   <div class="prod-price">
                      <h4 class="prod-price">${item.price} MDL</h4>
                      <div class="star-item-single">${htmlStars}
                      <br><small>${item.selled} cantități cumpărate</small></div>
                   </div>
                </div>
            `;
        });

    } else {
        html = "<div class='card col-md-12 mb-4'>Nu sunt servicii disponibile pe site!</div>";
    }

    displayServices.innerHTML = html;

    addCartRender();
    addWishListRender();
}

function newServicesIndexPage() {
    array = localStorage.getItem("services_array");
    if (array) array = JSON.parse(array); else array = [];

    displayServices = document.querySelector("#displayNewServices");
    html = "";

    array = array.slice(1).slice(-4);

    if (array && array.length) {
        array.forEach((item) => {

            let htmlStars = "";
            for(let i=1; i <= item.stars; i++) {
                htmlStars += `<i class="fa fa-star"></i>`;
            }

            html += `
                <div class="col-lg-3 col-sm-6 col-6 pb-3 prod-item scrollpoz">
                   <figure>
                      <div class="add-whis jsaddwishlist" data-id="${item.id}" data-name="${item.name}" data-price="${item.price}" data-stars="${item.stars}" data-image="${item.image}">
                         <i class="fa fa-heart"></i>
                      </div>
                      <div class="add-cart jsaddcart" data-id="${item.id}" data-amount="${item.amount}" data-name="${item.name}" data-price="${item.price}" data-image="${item.image}">
                         <i class="fa fa-shopping-basket"></i>
                      </div>
                      <a href="serviciu.html?id=${item.id}">
                      <img src="${item.image}" alt="image">
                      </a>
                   </figure>
                   <center><small>tip: ${item.type}</small></center>
                   <h3>
                      <a href="serviciu.html?id=${item.id}" title="">${item.name}</a>
                   </h3>
                   <div class="prod-price">
                      <h4 class="prod-price">${item.price} MDL</h4>
                      <div class="star-item-single">${htmlStars}
                      <br><small>${item.selled} cantități cumpărate</small></div>
                   </div>
                </div>
            `;
        });

    } else {
        html = "<div class='card col-md-12 mb-4'>Nu sunt servicii disponibile pe site!</div>";
    }

    displayServices.innerHTML = html;
}

function mostSelledIndexPage() {
    array = localStorage.getItem("services_array");
    if (array) array = JSON.parse(array); else array = [];

    displayServices = document.querySelector("#displayMostSelledServices");
    html = "";

    if (array && array.length) {

        array.sort(function (x, y) {
            return x.selled - y.selled;
        });
        array = array.slice(Math.max(array.length - 2, 0));

        array.forEach((item) => {
            let htmlStars = "";
            for(let i=1; i <= item.stars; i++) {
                htmlStars += `<i class="fa fa-star"></i>`;
            }

            html += `
                <div class="col-md-6 col-12 prod-item scrollpoz pb-3">
                   <figure>
                      <div class="add-whis jsaddwishlist" data-id="${item.id}" data-name="${item.name}" data-price="${item.price}" data-stars="${item.stars}" data-image="${item.image}">
                         <i class="fa fa-heart"></i>
                      </div>
                      <div class="add-cart jsaddcart" data-id="${item.id}" data-amount="${item.amount}" data-name="${item.name}" data-price="${item.price}" data-image="${item.image}">
                         <i class="fa fa-shopping-basket"></i>
                      </div>
                      <a href="serviciu.html?id=${item.id}">
                      <img src="${item.image}">
                      </a>
                   </figure>
                   <center><small>tip: ${item.type}</small></center>
                   <h3>
                      <a href="serviciu.html?id=${item.id}">${item.name}</a>
                   </h3>
                   <div class="prod-price">
                      <h4 class="prod-price">${item.price} MDL</h4>
                      <div class="star-item-single">${htmlStars}
                      <br><small>${item.selled} cantități cumpărate</small></div>
                   </div>
                </div>
                `;
        });

    } else {
        html = "<div class='card col-md-12 mb-4'>Nu sunt servicii disponibile pe site!</div>";
    }

    displayServices.innerHTML = html;

    addCartRender();      // randeaza si pentru newServicesIndexPage()
    addWishListRender();  // randeaza si pentru newServicesIndexPage()
}

function insertServices() {
    array = [];
    finalarray = localStorage.getItem("services_array");
    if (finalarray) finalarray = JSON.parse(finalarray); else finalarray = [];

    $error = 0;

    if (finalarray && finalarray.length) {
        finalarray.forEach((item) => {
            for(id = 1; id <= 8; id++) {
                if (item.id == id) {
                    $error = 1;
                }
            }
        });
    }
    // type 1 - sanatate, type 2 - infrumusetare, type 3 - altele
    if ($error == 0) {
        for(id = 1; id <= 8; id++) {
            if (id == 1) {
                name = "Prevenirea trombofeblitei";
                price = 300;
                image = "https://i.imgur.com/zunvmCF.jpg";
                amount = 1;
                stars = 3;
                type = "altele";
                selled = 0;
                description = "none";
            }

            if (id == 2) {
                name = "Reducerea obezitatii";
                price = 400;
                image = "https://i.imgur.com/d2Hxi1L.jpg";
                amount = 1;
                stars = 5;
                type = "infrumusetare";
                selled = 0;
                description = "none";
            }

            if (id == 3) {
                name = "Prevenirea varicelor";
                price = 100;
                image = "https://i.imgur.com/xEt8TiT.jpg";
                amount = 1;
                stars = 4;
                type = "infrumusetare";
                selled = 0;
                description = "none";
            }

            if (id == 4) {
                name = "Masaj terapeutic";
                price = 350;
                image = "https://i.imgur.com/b5c7zNK.jpg";
                amount = 1;
                stars = 5;
                type = "altele";
                selled = 2;
                description = "none";
            }

            if (id == 5) {
                name = "Detoxifierea totală a organismului";
                price = 300;
                image = "https://i.imgur.com/bGpsc1K.jpg";
                amount = 1;
                stars = 3;
                type = "sanatate";
                selled = 0;
                description = "none";
            }

            if (id == 6) {
                name = "Accelerarea procesului de cicatrizare";
                price = 250;
                image = "https://i.imgur.com/MEwpSJy.jpg";
                amount = 1;
                stars = 2;
                type = "altele";
                selled = 0;
                description = "none";
            }

            if (id == 7) {
                name = "Creșterea activității sistemului imunitar";
                price = 700;
                image = "https://i.imgur.com/0b6PVLC.jpg";
                amount = 1;
                stars = 5;
                type = "sanatate";
                selled = 0;
                description = "none";
            }

            if (id == 8) {
                name = "Reducerea celulitei";
                price = 300;
                image = "https://i.imgur.com/WfftW0N.jpg";
                amount = 1;
                stars = 4;
                type = "sanatate";
                selled = 0;
                description = "none";
            }

            array = {id, name, price, amount, image, stars, type, selled, description};
            finalarray.push(array);
        }
        localStorage.setItem("services_array", JSON.stringify(finalarray));

        fire("success", "Ai adăugat serviciile automate cu succes!");
    } else {
        fire("error", "Ai adăugat deja serviciile automate!");
    }
}

function insertService() {
    array = [];
    finalarray = localStorage.getItem("services_array");
    if (finalarray) finalarray = JSON.parse(finalarray); else finalarray = [];

    id = 9;
    name = document.querySelector("[name='name']").value;
    price = document.querySelector("[name='price']").value;
    amount = document.querySelector("[name='amount']").value;
    image = document.querySelector("[name='image']").value;
    stars = document.querySelector("[name='stars']").value;
    type = document.querySelector("[name='type']").value;
    selled = document.querySelector("[name='selled']").value;
    description = document.querySelector("[name='description']").value;

    error = undefined;

    if (!id || !name || !price || !amount || !image || !stars || !type || !selled || !description)
        error = "Nu ai completat tot formularul, nu lăsa nici o casetă liberă!";

    if (type != "toate" && type != "infrumusetare" && type != "sanatate" && type != "altele")
        error = "Tip invalid, tipuri disponibile: (toate), (infrumusetare), (sanatate), (altele).";

    if (finalarray && finalarray.length) {
        last = finalarray.at(-1);
        id = parseInt(last.id)+1;

        finalarray.forEach((item) => {
                if (item.name == name) {
                    error = `Numele '${name}'' există deja, alege alt nume!`;
                }
        });
    }

    if (error == undefined) {
        array = {id, name, price, amount, image, stars, type, selled, description};
        finalarray.push(array);
        localStorage.setItem("services_array", JSON.stringify(finalarray));

        fire("success", `Serviciul '${name}', 'ID: ${id}' a fost adăugat cu succes!`);
    } else {
        fire("error", error);
    }
}

function localstorageDelete() {
    localStorage.clear();
    fire("success", "Toate local Storage-urile existente au fost șterse cu succes!");
}

function isLogged() {
    accounts = localStorage.getItem("accounts_array");
    if (accounts) accounts = JSON.parse(accounts); else accounts = [];

    isLogged = localStorage.getItem("isLogged");
    if (isLogged) isLogged = JSON.parse(isLogged); else isLogged = [];
    accountLogged = accounts.find(element => element.id == isLogged);

    if (isLogged && accountLogged) return accountLogged; else return 0;      
}

function loginPage() {
    if (UserisLogged) {
        alert(`Ești deja logat pe website!`);
        window.location.replace("index.html");
    }

    loginButton = document.querySelector(".login-button");

    loginButton.addEventListener('click', () => {
        password = document.querySelector("[name='password']").value;
        email = document.querySelector("[name='email']").value;
        error = "";

        accounts = localStorage.getItem("accounts_array");
        if (accounts) accounts = JSON.parse(accounts); else accounts = [];

        if (!password || !email) error = "Nu ai întrodus numele sau e-mail-ul!";

        isAccount = accounts.find(element => element.email == email && element.password == MD5(password)); 
        if (!isAccount) error = "Verifică corectitudinea datelor, contul nu a fost găsit!";
            if (!error) {
                localStorage.setItem("isLogged", isAccount.id);
                alert("Te-ai logat cu succes!");
                window.location.replace("index.html");
            } else return toast("error", error);
    });
}

function registerPage() {
    if (UserisLogged) {
        alert(`Ești deja logat pe website!`);
        window.location.replace("index.html");
    }

    registerButton = document.querySelector(".register-button");

    registerButton.addEventListener('click', () => {
        username1 = document.querySelector("[name='username1']").value;
        username2 = document.querySelector("[name='username2']").value;
        username = username1 + " " + username2;
        email = document.querySelector("[name='email']").value;
        input_password = document.querySelector("[name='password']").value;
        password = MD5(input_password);
        admin = 0;
        id = 1;
        error = "";

        if (!username1 || !username2 || !email || !input_password) error = "Completează toate câmpurile libere!";

        insert = {};
        accounts = localStorage.getItem("accounts_array");
        if (accounts) accounts = JSON.parse(accounts); else accounts = [];

        isEmail = accounts.find(element => element.email == email);
        if (isEmail) error = "Există deja un cont cu acest E-Mail!";
        isUsername = accounts.find(element => element.username == username);
        if (isUsername) error = "Există deja un cont cu acest nume și prenume!";

        image = "https://i.imgur.com/t5yXH1Z.jpg";
        date = new Date().toLocaleDateString("en-US")+" "+new Date().toLocaleTimeString("en-US");

        if (!error) {
            if (accounts && accounts.length) {
                last = accounts.at(-1);
                id = parseInt(last.id)+1;
            }
            if (id == 1 || email == "admin@gmail.com") admin = 1;
            insert = {id, username, email, password, admin, image, date};
            accounts.push(insert);
            localStorage.setItem("accounts_array", JSON.stringify(accounts));
            alert("Te-ai înregistrat cu succes, acum te poți loga!");
            window.location.replace("login.html");
        } else toast("error", error);
    });
}

function search() {
    searchButton = document.querySelectorAll(".search-button");
    searchText = document.querySelectorAll("[name='search-text']")
    searchButton.forEach((item) => {
        item.addEventListener('click', () => {
            searchText.forEach((text) => {
                if (text.value) {
                    array = localStorage.getItem("services_array");
                    if (array) array = JSON.parse(array); else array = [];
                    array = array.filter(element => element.name.toLowerCase().includes(text.value.toLowerCase()));
                    if (array.length) window.location.replace("search.html?text="+text.value);
                    else fire("error", `Nu s-au găsit servicii ce conțin titlul '${text.value}'!`);
                    text.value = "";
                } else text.value = "";
            });
        });
    });
}
search();

function searchPage() {
    locationSearch = window.location.search;
    text = new URLSearchParams(locationSearch).get('text');

    searchPage = document.querySelector("#searchPageHTML");

    array = localStorage.getItem("services_array");
    if (array) array = JSON.parse(array); else array = [];

    html = "";

    if (text) array = array.filter(element => element.name.toLowerCase().includes(text.toLowerCase()));

    if (array && array.length) {
        array.forEach((item, index) => {
            html += `
                <div class="col-md-4 mb-2">
                   <div class="row">
                      <div class="col-md-4">
                         <figure>
                            <a class="prod-img-new" href="serviciu.html"><img src="${item.image}"></a>
                         </figure>
                      </div>
                      <div class="col-md-8">
                         <h3>
                            <a href="serviciu.html?id=${item.id}">${item.name}</a>
                         </h3>
                         <h4 class="prod-price">${item.price} MDL</h4>
                      </div>
                   </div>
                </div>
            `;
        });
    } else html = `<div class='card col-md-12 mb-4'>Nu s-au găsit servicii ce conțin titlul '${text}'!</div>`;

    if (!text) html = `<div class='card col-md-12 mb-4'>Parametrii URL-ului nu corespund!</div>`;

    searchPage.innerHTML = html;
}

function adminPage() {
   if (!UserisLogged) {
      alert("Nu ești logat, logează-te!");
      window.location.replace("login.html");
   }
   if (UserisLogged.admin < 1) {
      alert("Nu ești Administrator pe website!");
      window.location.replace("index.html");
   }
}

function contactPage() {
   contactBtn = document.querySelector(".button-contact");
   contactBtn.addEventListener('click', () => {
      surname = document.querySelector("[name='surname']");
      email = document.querySelector("[name='email']");
      message = document.querySelector("[name='message']");

      console.log(surname.value);

      if (!surname.value || !email.value || !message.value) fire("error", "Completează toate câmpurile libere!"); else {
         fire("success", `Mulțumim pentu mesaj, ${surname.value}, îl vom citi în cel mai scurt timp posibil!`);
         surname.value = "";
         email.value = "";
         message.value = "";
      }
   });
}

/* Sweetalert2 Functions */
function toast(type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    return Toast.fire({
        icon: type,
        title: message
    });
}

function fire(type, message) {
    return Swal.fire({
        icon: type,
        text: message
    });
}