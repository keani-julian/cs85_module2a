<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>T-Shirt Price Engine</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f6f8; color: #333; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .receipt { background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 400px; border-top: 5px solid #005a9c; }
        h1 { text-align: center; color: #005a9c; }
        ul { list-style: none; padding: 0; }
        li { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .total { font-size: 1.5em; color: #28a745; }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Order Summary</h1>
        <?php
            // --- Configuration: Change these values to test all business rules! ---
            $size = 'XL'; // Options: 'S', 'M', 'L', 'XL'
            $color = 'Sunset Orange'; // Any string, but test with 'Sunset Orange' or 'Ocean Blue'
            $isCustomized = true; // Options: true, false
            $customerFirstName = 'Keani'; // <-- IMPORTANT: REPLACE WITH YOUR ACTUAL FIRST NAME

            // --- Part A: Implement the logic below using ONLY simple, nested if-statements ---
            $finalPrice = 22.50;
            $details = "<li>Base Price: <span>$" . number_format($finalPrice, 2) . "</span></li>";

            // Your nested if-statement logic goes here...
            // Example of a rule:
            // if ($size == 'L') {
            //     $finalPrice = $finalPrice + 1.75;
            //     $details .= "<li>Size (L) Upcharge: <span>+$1.75</span></li>";
            // }
            
            //nts: size upcharge
            if ($size == 'L') {
                $finalPrice = $finalPrice + 1.75;
                $details .= "<li>Size (L) Upcharge: <span>+$1.75</span></li>";
            } elseif ($size == 'XL') {
                $finalPrice = $finalPrice + 2.50;
                $details .= "<li>Size (XL) Upcharge: <span>+$2.50</span></li>";
            }
            //nts: premium color upcharge
            if ($color == 'Sunset Orange' || $color == 'Ocean Blue') {
                $finalPrice = $finalPrice + 2.00;
                $details .= "<li>Premium Color: <span>+$2.00</span></li>";
            }
            // nts: customization fee and XL hanlding fee flattened
            if ($isCustomized) {
                $finalPrice = $finalPrice + 5.00;
                $details .= "<li>Customization Fee: <span>+$5.00</span></li>";
            }
            if ($isCustomized && $size == 'XL') {
                $finalPrice = $finalPrice + 3.00;
                $details .= "<li>XL Handling Fee: <span>+$3.00</span></li>";
            }
            // nts: personalized discount for long name
            if (strlen($customerFirstName) > 6) {
                $finalPrice = $finalPrice - 1.00;
                $details .= "<li>Long Name Discount: <span>-$1.00</span></li>";
            }

            /*
            MY REFACTOR DEBUGGING REFLECTION: 
            Issue: While testing the premium color rule, my total came out lower than I expected
            and the "Premium Color" line never showed up in the receipt. When refactoring, I had initially set the color to
            'ocean blue' instead of 'Ocean Blue'. The page didn't throw any error — it
            just didn't register the upcharge, which made it confusing at first because nothing
            looked like it was broken.
            Solution: 
            I compared both URLs side by side and used the receipt's line items to narrow it down. 
            Since the Premium Color line item was missing entirely, I knew the if-condition was evaluating to false rather than
            the math being wrong. That pointed me at the comparison itself. I realized PHP's ==
            compares strings character-for-character and is case-sensitive, so 'ocean blue' never
            matched 'Ocean Blue'. Fixing the capitalization in my test config made the upcharge
            apply correctly.
            */

            // --- DO NOT EDIT BELOW THIS LINE ---
            echo "<ul>" . $details . "</ul>";
            echo "<ul><li><span class='total'>Final Price:</span> <span class='total'>$" . number_format($finalPrice, 2) . "</span></li></ul>";

        ?>
    </div>
</body>
</html>