<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    //
    
    /**
     * Seguir a un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function followUser(Request $request, User $user)
    {
        $authenticatedUser = Auth::user();
        
        if ($user->id === $authenticatedUser->id) {
            return response()->json([
                'message' => 'No puedes seguirte a ti mismo.'
            ], 403);
        }
        
        $authenticatedUser->followed()->attach($user->id);

        return response()->json([
            'message' => 'Ahora sigues a este usuario.'
        ]);
    }

    /**
     * Dejar de seguir a un usuario.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollowUser(User $user)
    {
        $authenticatedUser = Auth::user();

        $authenticatedUser->followed()->detach($user->id);

        return response()->json([
            'message' => 'Has dejado de seguir a este usuario.'
        ]);
    }

    /**
     * Seguir una categoría.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function followCategory(Request $request, Category $category)
    {
        $authenticatedUser = Auth::user();

        $authenticatedUser->followed()->attach($category->id);

        return response()->json([
            'message' => 'Ahora sigues esta categoría.'
        ]);
    }

    /**
     * Dejar de seguir una categoría.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollowCategory(Category $category)
    {
        $authenticatedUser = Auth::user();

        $authenticatedUser->followed()->detach($category->id);

        return response()->json([
            'message' => 'Has dejado de seguir esta categoría.'
        ]);
    }

    /**
     * Seguir un producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function followProduct(Request $request, Product $product)
    {
        $authenticatedUser = Auth::user();

        $authenticatedUser->followed()->attach($product->id);

        return response()->json([
            'message' => 'Ahora sigues este producto.'
        ]);
    }

    /**
     * Dejar de seguir un producto.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollowProduct(Product $product)
    {
        $authenticatedUser = Auth::user();

        $authenticatedUser->followed()->detach($product->id);

        return response()->json([
            'message' => 'Has dejado de seguir este producto.'
        ]);
    }
}
