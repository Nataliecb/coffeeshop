var d = document,
    itemBox = d.querySelectorAll('.item_box'), 
    cartCont = d.getElementById('cart_content'),
    cart = d.getElementById("cart");

d.getElementById("empty-cart").onmouseover = function() {
    d.getElementById("empty-cart-text").innerHTML = "Добавьте товары в корзину";
    cart.style.background = "#b8c0e5";
}
d.getElementById("empty-cart").onmouseout = function() {
    d.getElementById("empty-cart-text").innerHTML = "Корзина пуста";
    cart.style.background = "#efefef";
}

function addEvent(elem, type, handler){
  if(elem.addEventListener){
    elem.addEventListener(type, handler, false);
  } else {
    elem.attachEvent('on'+type, function(){ handler.call( elem ); });
  }
  return false;
}

function getCartData(){
	return JSON.parse(localStorage.getItem('cart'));
}

function setCartData(o){
	localStorage.setItem('cart', JSON.stringify(o));
	return false;
}

function addToCart(e){
	this.disabled = true;
    d.getElementById('total_count').style.display = 'block';
	var cartData = getCartData() || {}, 
			parentBox = this.parentNode, 
			itemId = this.getAttribute('data-id'),
			itemTitle = parentBox.querySelector('.item_title').innerHTML,
			itemPrice = parentBox.querySelector('.item_price').innerHTML,
            itemImgSrc = parentBox.querySelector('.pic-image').getAttribute('src'),
            itemWeightId = parentBox.querySelector('.item_weight').value,
            itemGristId = parentBox.querySelector('.item_grist').value,
            itemWeight = parentBox.querySelector('.item_weight').options[itemWeightId-1].text,
            itemGrist = parentBox.querySelector('.item_grist').options[itemGristId-1].text,
            itemTitleColor = parentBox.querySelector('.item_title').style.color='#5757ce',
            itemSpan = parentBox.querySelector('.pic-caption').style.background='rgba(184, 192, 229, 0.89)',
            itemWeightBorder = parentBox.querySelector('.item_weight').style.border = '2px solid #B8C0E5',
            itemGristBorder = parentBox.querySelector('.item_grist').style.border = '2px solid #B8C0E5',
            itemPriceColor = parentBox.querySelector('.item_price').style.color = '#B8C0E5',
            itemButton = parentBox.querySelector('.add_item').style.background='#B8C0E5',
            itemButtonTextHover = parentBox.querySelector('.add_item').onmouseover = function() {
                this.innerHTML = 'Добавить еще';
            },
            itemButtonText = parentBox.querySelector('.add_item').onmouseout = function() {
                this.innerHTML = '<i class="fa fa-check"></i>Добавлено';
            };
    
    var itemIdCart = itemId+'_w'+itemWeightId+'_g'+itemGristId;
    if (cartData.hasOwnProperty(itemIdCart)) {
            cartData[itemIdCart][2] += 1; 
    } else {
        switch(itemWeight) {
            case '2 кг':
                itemPrice = parseInt(itemPrice) * 2 * 0.85;
            break;
            case '1 кг':
                itemPrice = parseInt(itemPrice);
            break;
            case '500 г':
                itemPrice = parseInt(itemPrice) / 2 * 1.4;
            break;
            case '250 г':
                itemPrice = parseInt(itemPrice) / 4 * 2;
            break;
        }
        cartData[itemIdCart] = [itemTitle, itemPrice, 1, itemImgSrc, itemWeight, itemGrist, itemIdCart, itemId];
    } 
    var count = 0;
    for(var item in cartData) {
        count++;
    }
    var totalItems = '';
	console.log(JSON.stringify(cartData));
    total_val = 0;
	if(cartData !== null){
		totalItems = '<table class="cart-table table" id="cart-table"><thead><tr><th>№</th><th>Наименование</th><th>Вес</th><th>Помол</th><th>Цена</th><th>Количество</th><th>Итог</th><th></th></tr>';
        var n = 0;
		for(var items in cartData){
			totalItems += '<tr>';
            n++;
			for(var i = 0; i < cartData[items].length; i++){
                num = '<td class="count_item">' + n + '</td>';
				title = '<td><img src="' + cartData[items][3] + '" alt=""/><p id="name_item">' + cartData[items][0] + '</p></td>';
                weight = '<td id="weight_item">' + cartData[items][4] + '</td>';
                grist = '<td id="grist_item">' + cartData[items][5] + '</td>';
                price = '<td id="price_item" class="price_item">' + cartData[items][1] + ' грн</td>';
                qty = '<td><input type="number" name="number" id="number_item" class="number_item" min="1" step="1" value="' + cartData[items][2] + '"/><input type="hidden" name="remove-dish-id" class="remove-dish" value="'+ cartData[items][6]+'" /></td>';
                total = '<td id="total_price_item" class="total_price_item">'+ cartData[items][1] * cartData[items][2] +' грн</td>';
                del = '<td><a id="delete" class="delete_item" data-pr="'+cartData[items][6]+'" onclick="delItem(this)"></a></td>';
			}
            itemTotalPrice = parseFloat(cartData[items][1]) * cartData[items][2];
            total_val += itemTotalPrice;
            totalItems += num + title + weight + grist + price + qty + total + del;
			totalItems += '</tr>';
		}
        totalItems += '</table>';
        total_price.innerHTML = total_val + ' грн';
		cartCont.innerHTML = totalItems;

        $(".number_item").bind('keyup mousemove', function () {
            var x = d.getElementsByClassName("price_item");
            var p = d.getElementsByName("remove-dish-id");
            var total_p = d.getElementsByClassName("total_price_item");
            var hidden_count_id = $(this).next("input").val();
            var cartData = getCartData();
            for (var j=0; j<x.length; j++) {
                var price = parseFloat(x[j].innerHTML);
                var hidden_price_id  = p[j].value;
                if (hidden_price_id === hidden_count_id) {
                    var count = $(this).val();
                    var summa = count*price; 
                    total_p[j].innerHTML = summa + ' грн';
                    cartData[hidden_count_id][2] = parseInt(count);
                    localStorage["cart"] = JSON.stringify(cartData);
                    var total_summ = 0;
                     $('.total_price_item').each(function() {
						total_summ += parseFloat($(this).text());
					});
               } 
            }
            document.getElementById('total_price').innerHTML = parseFloat(total_summ) + ' грн';
        });
        $('#empty-cart').hide(200);
        $('#cart_content').show(200);
        $('#total').show(200);
	} else {
        alert('hii');
        $('#cart_content').hide(200);
        $('#total').hide(200);
        $('#empty-cart').show(200);
	}
    d.getElementById('total_count').style.opacity = 1;
    localStorage.setItem('count', count);
    d.getElementById('total_count').innerHTML = count;
	if(!setCartData(cartData)){ 
		this.disabled = false; 
	}
	return false;
}

for(var i = 0; i < itemBox.length; i++){
	addEvent(itemBox[i].querySelector('.add_item'), 'click', addToCart);
   
}

function openCart() {
    var cartData = getCartData();
    if (cartData == null) {
        $('#empty-cart').show(200);
    }
    $('#cart').animate({
        "height": "toggle"
    }, 1000);
}

function delItem(e){
    var cartData = getCartData();
    var key = e.getAttribute("data-pr");
    var total_summ = 0;
    e.closest('tr').remove();
    delete cartData[key];
    localStorage["cart"] = JSON.stringify(cartData); 
    var items = d.getElementsByClassName("count_item");
    var total_price = d.getElementsByClassName("total_price_item");
    if (items.length === 0) {
        d.getElementById('total_count').style.display = "none";
        $('#cart_content').hide(200);
        $('#total').hide(200);
        $('#empty-cart').show(200);  
    } else {
        $('#empty-cart').hide(200);
        d.getElementById('total_count').innerHTML = items.length;
        for( var t=0; t<=items.length; t++) {
            total_summ += parseFloat(total_price[t].innerHTML);
            items[t].innerHTML = t+1;
            d.getElementById('total_price').innerHTML = total_summ + ' грн';
        }
    }
}

addEvent(d.getElementById('checkout'), 'click', openCart);
addEvent(d.getElementById('clear_cart'), 'click', function(e){
    $('#cart_content').hide(200);
    $('#empty-cart').show(200);
	localStorage.removeItem('cart');
    localStorage.removeItem('count');
    d.getElementById('total').style.display = 'none';
    d.getElementById('total_count').style.display = 'none';
    var button = d.getElementsByClassName('add_item');
    var titleColor = d.getElementsByClassName('item_title');
    var span = d.getElementsByClassName('pic-caption');
    var weightBorder = d.getElementsByClassName('item_weight');
    var gristBorder = d.getElementsByClassName('item_grist');
    var priceColor = d.getElementsByClassName('item_price');
    for(var i=0; i<=button.length; i++) {
        button[i].style.background = '#60BDCE';
        button[i].innerHTML = '<i class="fa fa-plus"></i>Добавить';
        button[i].onmouseover = function() {
            this.innerHTML = '<i class="fa fa-plus"></i>Добавить';
            this.style.background = "#0574a6";
        }
        button[i].onmouseout = function() {
            this.innerHTML = '<i class="fa fa-plus"></i>Добавить';
            this.style.background = "#60BDCE";
        }
        titleColor[i].style.color = '#3772A2';
        span[i].style.background = 'rgba(106, 180, 193, 0.89)';
        weightBorder[i].style.border = '2px solid #60BDCE';
        gristBorder[i].style.border = '2px solid #60BDCE';
        priceColor[i].style.color = '#60BDCE';
    }
});

function openNav() {
    d.getElementById("mySidenav").style.display = "block";
    d.getElementById("cart-table").style.width = "80%";
    d.getElementById("cart").style.marginRight = "10%";
    d.getElementById("continue").style.display = "none";
    d.getElementById("total").style.width = "80%";
    d.getElementById("total").style.margin = "0";
    var items = document.getElementsByClassName("count_item");
    var numbers = document.getElementsByClassName("number_item");
    var dels = document.getElementsByClassName("delete_item");
    for(var t=0; t<=items.length; t++) {
        numbers[t].disabled = true;
        dels[t].style.display = "none";
    }
}

function closeNav() {
    d.getElementById("mySidenav").style.display = "none";
    d.getElementById("cart-table").style.width = "100%";
    d.getElementById("cart").style.marginRight= "0";
    d.getElementById("continue").style.display = "block";
    d.getElementById("total").style.width = "100%";
    d.getElementById("total").style.margin = "auto";
    var items = document.getElementsByClassName("count_item");
    var numbers = document.getElementsByClassName("number_item");
    var dels = document.getElementsByClassName("delete_item");
    for(var t=0; t<=items.length; t++) {
        numbers[t].disabled = false;
        dels[t].style.display = "block";
    }
}

function toSimpleJson(serializedData) {
    var ar1 = serializedData.split("&");
    var json = '';
    for (var i = 0; i<ar1.length; i++) {
        var ar2 = ar1[i].split("=");
        json += i > 0 ? ", " : "";
        json += "" + ar2[0] + " => ";
        json += "" + (ar2.length < 2 ? "" : ar2[1]) + "";
    }
    //json += "}";
    return json;
}

function call() {
    var orderData = $('#order_form').serialize();
    var orderDataJson = toSimpleJson(orderData);
    var cartData = getCartData();
    $.ajax({
      type: 'POST',
      url: 'order.php',
      data: {
          order: orderDataJson,
          cart: cartData
      },
      success: function(data) {
        $('#results').html(data);
      },
      error:  function(xhr, str){
    alert('Возникла ошибка: ' + xhr.responseCode);
      }
    });
}  