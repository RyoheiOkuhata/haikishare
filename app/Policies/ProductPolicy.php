<?php

namespace App\Policies;

use App\User;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)//？をつけることで未ログインユーザーも許可する
    {
        return true;//indexは誰でも見れる必要があるためtrueを返す
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function view(?User $user, Product $product)//？をつけることで未ログインユーザーも許可する
    {
        return true; //showは誰でも見れる必要があるためtrueを返す
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function update(User $user, Product  $product)
    {
        return $user->id === $product->user_id;
        //ログイン中のユーザーのIDとプロダクトモデルのユーザーIDが一致すればtrue
        //投稿者以外のユーザーが編集出来ないようにする
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function delete(User $user, Product  $product)
    {
        return $user->id === $product->user_id;
    //ログイン中のユーザーのIDと記事モデルのユーザーIDが一致すればtrue
    //投稿者以外のユーザーが消去出来ないようにする
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function restore(User $user, Product  $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param  \App\User  $user
     * @param  \App\product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product  $product)
    {
        //
    }
}
