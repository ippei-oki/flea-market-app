<div class="subtotal">
  <table class="subtotal-table">
    <tr>
      <td class="no-right-border">商品代金</td>
      <td class="no-left-border">￥{{ number_format($subtotal) }}</td>
    </tr>
    <tr>
      <td class="no-right-border">支払い方法</td>
      <td class="no-left-border">
        @if ($paymentMethod === 'convenience_store')
          コンビニ払い
        @elseif ($paymentMethod === 'card')
          カード支払い
        @else
          未選択
        @endif
      </td>
    </tr>
  </table>
</div>