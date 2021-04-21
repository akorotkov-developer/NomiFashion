BX.namespace("BX.Catalog.SetConstructor");

BX.Catalog.SetConstructor = (function()
{
	var SetConstructor = function(params)
	{
		this.numSliderItems = params.numSliderItems || 0;
		this.numSetItems = params.numSetItems || 0;
		this.jsId = params.jsId || "";
		this.ajaxPath = params.ajaxPath || "";
		this.currency = params.currency || "";
		this.lid = params.lid || "";
		this.iblockId = params.iblockId || "";
		this.basketUrl = params.basketUrl || "";
		this.setIds = params.setIds || null;
		this.offersCartProps = params.offersCartProps || null;
		this.itemsRatio = params.itemsRatio || null;
		this.noFotoSrc = params.noFotoSrc || "";
		this.messages = params.messages;

		this.mainElementPrice = params.mainElementPrice || 0;
		this.mainElementOldPrice = params.mainElementOldPrice || 0;
		this.mainElementDiffPrice = params.mainElementDiffPrice || 0;
		this.mainElementBasketQuantity = params.mainElementBasketQuantity || 1;

		this.parentCont = BX(params.parentContId) || null;
		this.sliderItemsCont = this.parentCont.querySelector("[data-role='set-other-items']");
		this.setItemsCont = this.parentCont.querySelector("[data-role='set-items']");

		this.setPriceCont = this.parentCont.querySelector("[data-role='set-price']");
		this.setOldPriceCont = this.parentCont.querySelector("[data-role='set-old-price']");
		this.setDiffPriceCont = this.parentCont.querySelector("[data-role='set-diff-price']");

		this.notAvailProduct = this.sliderItemsCont.querySelector("[data-not-avail='yes']");

		this.emptySetMessage = this.parentCont.querySelector("[data-set-message='empty-set']");

		BX.bindDelegate(this.setItemsCont, 'click', { 'attribute': 'data-role' }, BX.proxy(this.deleteFromSet, this));
		BX.bindDelegate(this.sliderItemsCont, 'click', { 'attribute': 'data-role' }, BX.proxy(this.addToSet, this));

		var buyButton = this.parentCont.querySelector("[data-role='set-buy-btn']");
		BX.bind(buyButton, "click", BX.proxy(this.addToBasket, this));

		//this.generateSliderStyles();
	};

	SetConstructor.prototype.deleteFromSet = function()
	{
		var target = BX.proxy_context,
			item,
			itemId,
			itemName,
			itemUrl,
			itemImg,
			itemPrintPrice,
			itemPrice,
			itemPrintOldPrice,
			itemOldPrice,
			itemDiffPrice,
			itemMeasure,
			itemBasketQuantity,
			i,
			l,
			newSliderNode;

		if (target && target.hasAttribute('data-role') && target.getAttribute('data-role') == 'set-delete-btn')
		{
			item = target.parentNode;

			itemId = item.getAttribute("data-id");
			itemName = item.getAttribute("data-name");
			itemUrl = item.getAttribute("data-url");
			itemImg = item.getAttribute("data-img");
			itemPrintPrice = item.getAttribute("data-print-price");
			itemPrice = item.getAttribute("data-price");
			itemPrintOldPrice = item.getAttribute("data-print-old-price");
			itemOldPrice = item.getAttribute("data-old-price");
			itemDiffPrice = item.getAttribute("data-diff-price");
			itemMeasure = item.getAttribute("data-measure");
			itemBasketQuantity = item.getAttribute("data-quantity");

            var parentContId = this.parentCont.getAttribute("id"),
                $parentSet = $('#' + parentContId),
                $self = $parentSet.find('.product-pack-carousel .item[data-id=' + itemId + ']').find('a[data-role=set-delete-btn]'),
                $carouselVariation = $self.closest('.product-pack').find('.product-carousel'),
                itemOwl = removeOwlItem($self);

            if ($carouselVariation.data('owl.carousel') === undefined) {
                $carouselVariation.append(itemOwl);
                $carouselVariation.owlCarousel($carouselVariation.data('owlParams'));
                $parentSet.find('.product-pack-caption.pack').show();
                $parentSet.find('.product-pack-variation').slideDown();
            } else {
                if ($carouselVariation.data('owl.carousel')._items.length <= 0) {
                    $parentSet.find('.product-pack-caption.pack').show();
                    $parentSet.find('.product-pack-variation').slideDown();
                }
                $carouselVariation.trigger('add.owl.carousel', [itemOwl]);
            }
            $carouselVariation.find('.item[data-id=' + itemId + '] .product-pack-change').attr('data-role', 'set-add-btn');
            $carouselVariation.trigger('refresh.owl.carousel');
            $carouselVariation.trigger('next.owl.carousel');

			this.numSliderItems++;
			this.numSetItems--;

			for (i = 0, l = this.setIds.length; i < l; i++)
			{
				if (this.setIds[i] == itemId)
					this.setIds.splice(i, 1);
			}
			this.recountPrice();

			if (this.numSetItems <= 0 && !!this.emptySetMessage)
				BX.adjust(this.emptySetMessage, { style: { display: 'inline-block' }, html: this.messages.EMPTY_SET });
		}
	};

	SetConstructor.prototype.addToSet = function()
	{
		var target = BX.proxy_context,
			item,
			itemId,
			itemName,
			itemUrl,
			itemImg,
			itemPrintPrice,
			itemPrice,
			itemPrintOldPrice,
			itemOldPrice,
			itemDiffPrice,
			itemMeasure,
			itemBasketQuantity,
			newSetNode;

		if (!!target && target.hasAttribute('data-role') && target.getAttribute('data-role') == 'set-add-btn')
		{
			item = target.parentNode;

			itemId = item.getAttribute("data-id");
			itemName = item.getAttribute("data-name");
			itemUrl = item.getAttribute("data-url");
			itemImg = item.getAttribute("data-img");
			itemPrintPrice = item.getAttribute("data-print-price");
			itemPrice = item.getAttribute("data-price");
			itemPrintOldPrice = item.getAttribute("data-print-old-price");
			itemOldPrice = item.getAttribute("data-old-price");
			itemDiffPrice = item.getAttribute("data-diff-price");
			itemMeasure = item.getAttribute("data-measure");
			itemBasketQuantity = item.getAttribute("data-quantity");

            var parentContId = this.parentCont.getAttribute("id"),
                $parentSet = $('#' + parentContId),
                $self = $parentSet.find('.product-carousel .item[data-id=' + itemId + ']').find('a[data-role=set-add-btn]'),
                $carouselPack = $self.closest('.product-pack').find('.product-pack-carousel'),
                $carouselVariation = $self.closest('.product-carousel'),
                owlVariation = $carouselVariation.data('owlCarousel'),
                itemOwl = removeOwlItem($self);

            if ($carouselVariation.data('owl.carousel')._items.length <= 0) {
                $parentSet.find('.product-pack-caption.pack').hide();
                $parentSet.find('.product-pack-variation').slideUp();
            }
            
            $carouselPack.trigger('add.owl.carousel', [itemOwl]);
            $carouselPack.find('.item[data-id=' + itemId + '] .product-pack-change').attr('data-role', 'set-delete-btn');
            $carouselPack.trigger('refresh.owl.carousel');
            $carouselPack.trigger('next.owl.carousel');
            
			this.numSliderItems--;
			this.numSetItems++;

			this.setIds.push(itemId);
			this.recountPrice();

			if (this.numSetItems > 0 && !!this.emptySetMessage)
				BX.adjust(this.emptySetMessage, { style: { display: 'none' }, html: '' });
		}
	};

	SetConstructor.prototype.recountPrice = function()
	{
		var sumPrice = this.mainElementPrice*this.mainElementBasketQuantity,
			sumOldPrice = this.mainElementOldPrice*this.mainElementBasketQuantity,
			sumDiffDiscountPrice = this.mainElementDiffPrice*this.mainElementBasketQuantity,
			setItems = BX.findChildren(this.setItemsCont, {tagName: "div", className: "item"}, true),
			i,
			l,
			ratio;
		if (setItems)
		{
			for(i = 0, l = setItems.length; i<l; i++)
			{
				ratio = Number(setItems[i].getAttribute("data-quantity")) || 1;
				sumPrice += Number(setItems[i].getAttribute("data-price"))*ratio;
				sumOldPrice += Number(setItems[i].getAttribute("data-old-price"))*ratio;
				sumDiffDiscountPrice += Number(setItems[i].getAttribute("data-diff-price"))*ratio;
			}
		}

		this.setPriceCont.innerHTML = BX.Currency.currencyFormat(sumPrice, this.currency, true);
		if (Math.floor(sumDiffDiscountPrice*100) > 0)
		{
			this.setOldPriceCont.innerHTML = BX.Currency.currencyFormat(sumOldPrice, this.currency, true);
			this.setDiffPriceCont.innerHTML = this.messages.ECONOMY + ' <span>' + BX.Currency.currencyFormat(sumDiffDiscountPrice, this.currency, true) + '</span>';
		}
		else
		{
			this.setOldPriceCont.innerHTML = '';
			this.setDiffPriceCont.innerHTML = '';
		}
	};

	SetConstructor.prototype.addToBasket = function()
	{
		var target = BX.proxy_context,
            parentContId = this.parentCont.getAttribute("id"),
            $parentSet = $('#' + parentContId);

        setPackVariation($parentSet);
		$.fancybox.helpers.overlay.open({
            closeClick: false,
            parent: $('body'),
        });
        $.fancybox.showLoading();

		BX.ajax.post(
			this.ajaxPath,
			{
				sessid: BX.bitrix_sessid(),
				action: 'catalogSetAdd2Basket',
				set_ids: this.setIds,
				lid: this.lid,
				iblockId: this.iblockId,
				setOffersCartProps: this.offersCartProps,
				itemsRatio: this.itemsRatio
			},
			BX.proxy(function(result)
			{
                preview2Basket($parentSet.find('.product-pack-sum a[data-role=set-buy-btn]'));
                $.fancybox.hideLoading();
                $.fancybox.helpers.overlay.close();
                BX.onCustomEvent('OnBasketChange');
                updateAdd2Basket();
			}, this)
		);
	};

	return SetConstructor;
})();