Checkout page
<x-userHeader>
    <style>
        ul {
            list-style-type: none;
            padding: 0;
        }

        .checkout-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;     
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .checkout-container span {
            flex-grow: 1;
        }
        .checkout-container input[type="submit"] {
            background-color: #a463b1;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .checkout-container input[type="submit"]:hover {
            background-color: #8e3fa1;
        }
        .checkout-container input[type="submit"]:active {
            background-color: #7a368e;
        }
        .checkout-container input[type="submit"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(164, 99, 177, 0.5);
        }
        .checkout-container input[type="submit"]:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .checkout-btn {
            background-color: #a463b1;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .cart-checkbox {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
        }
        .checkout-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px 30px;
            background-color: #f9f9f9;
            border-top: 1px solid #ccc;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
            z-index: 100;
            display: flex;
            justify-content: space-between; 
            align-items: center;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            box-sizing: border-box;
            gap: 50px;
        }
    </style>
