import os
import re

directory = r'c:\laragon\www\Storemart_SaaS\resources\views\front'
updated = 0
for root, dirs, files in os.walk(directory):
    for file in files:
        if file.endswith('.blade.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # Use regex to find all bad patterns and fix them
            new_content = re.sub(
                r'currency_formate\(\s*\$price\s*,\s*\$storeinfo->id[^)]*\)',
                r'currency_formate($price, $storeinfo->id, $item->currency)',
                content
            )
            
            new_content = re.sub(
                r'currency_formate\(\s*\$original_price\s*,\s*\$storeinfo->id[^)]*\)',
                r'currency_formate($original_price, $storeinfo->id, $item->currency)',
                new_content
            )
            
            new_content = re.sub(
                r'currency_formate\(\s*\$cart->item_price\s*,\s*\$storeinfo->id[^)]*\)',
                r'currency_formate($cart->item_price, $storeinfo->id, $cart->currency)',
                new_content
            )
            
            new_content = re.sub(
                r'currency_formate\(\s*\$cart->price\s*,\s*\$storeinfo->id[^)]*\)',
                r'currency_formate($cart->price, $storeinfo->id, $cart->currency)',
                new_content
            )
            
            if new_content != content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f'Fixed {filepath}')
                updated += 1

print(f'Total fixed: {updated}')
