$(document).ready(function(){
	$(document).on('click', '.add_to_compare', function(e){
		e.preventDefault();
		if (typeof addToCompare != 'undefined')
			addToCompare(parseInt($(this).data('id-product')));
	});

	reloadProductComparison();
	compareButtonsStatusRefresh();
	totalCompareButtons();
});

function addToCompare(productId)
{
	var totalValueNow = parseInt($('.bt_compare').next('.compare_product_count').val());
	var action, totalVal;
	if($.inArray(parseInt(productId),comparedProductsIds) === -1)
		action = 'add';
	else
		action = 'remove';

	$.ajax({
		url: 'index.php?controller=products-comparison&ajax=1&action='+action+'&id_product=' + productId,
		async: true,
		cache: false,
		success: function(data) {
			if (action === 'add' && comparedProductsIds.length < comparator_max_item) {
				comparedProductsIds.push(parseInt(productId)),
				compareButtonsStatusRefresh(),
				totalVal = totalValueNow +1,
				$('.bt_compare').next('.compare_product_count').val(totalVal),
				totalValue(totalVal);
			}
			else if (action === 'remove') {
				comparedProductsIds.splice($.inArray(parseInt(productId),comparedProductsIds), 1),
				compareButtonsStatusRefresh(),
				totalVal = totalValueNow -1,
				$('.bt_compare').next('.compare_product_count').val(totalVal),
				totalValue(totalVal);
			}
			else
			{
	            if (!!$.prototype.fancybox)
	                $.fancybox.open([
	                    {
	                        type: 'inline',
	                        autoScale: true,
	                        minHeight: 30,
	                        content: '<p class="fancybox-error">' + max_item + '</p>'
	                    }
	                ], {
	                    padding: 0
	                });
	            else
	                alert(max_item);
			}
			totalCompareButtons();
		},
		error: function(){}
	});
}

function reloadProductComparison()
{
	$(document).on('click', 'a.cmp_remove', function(e){
		e.preventDefault();
		var idProduct = parseInt($(this).data('id-product'));
		$.ajax({
			url: 'index.php?controller=products-comparison&ajax=1&action=remove&id_product=' + idProduct,
			async: false,
			cache: false
		});
		$('td.product-'+idProduct).fadeOut(600);
	});
};

function compareButtonsStatusRefresh()
{
	$('.add_to_compare').each(function() {
		if ($.inArray(parseInt($(this).data('id-product')),comparedProductsIds)!== -1)
			$(this).addClass('checked');
		else
			$(this).removeClass('checked');
	});
}

function totalCompareButtons()
{
	var totalProductsToCompare = parseInt($('.bt_compare .total-compare-val').html());
	if (typeof totalProductsToCompare !== "number" || totalProductsToCompare === 0)
		$('.bt_compare').attr("disabled",true);
	else
		$('.bt_compare').attr("disabled",false);
}

function totalValue(value)
{
	$('.bt_compare').find('.total-compare-val').html(value);
}