<x-userHeader>

</x-userHeader>

{{ number_format(session('current_total_amount', 0), 2) }}
{{ implode(', ', session('selected_cart_items', [])) }}
  
