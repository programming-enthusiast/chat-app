<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*
* This is the main app route [Chat Messenger]
*/
Route::get('/chat', 'MessagesController@index')->name(config('chat.path'));

/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/chat/idInfo', 'MessagesController@idFetchData');

/**
 * Send message route
 */
Route::post('/chat/sendMessage', 'MessagesController@send')->name('send.message');

/**
 * Fetch messages 
 */
Route::post('/chat/fetchMessages', 'MessagesController@fetch')->name('fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/chat/download/{fileName}', 'MessagesController@download')->name(config('chat.attachments.route'));

/**
 * Authintication for pusher private channels
 */
Route::post('/chat/chat/auth', 'MessagesController@pusherAuth')->name('pusher.auth');

/**
 * Make messages as seen
 */
Route::post('/chat/makeSeen', 'MessagesController@seen')->name('messages.seen');

/**
 * Get contacts
 */
Route::post('/chat/getContacts', 'MessagesController@getContacts')->name('contacts.get');

/**
 * Update contact item data
 */
Route::post('/chat/updateContacts', 'MessagesController@updateContactItem')->name('contacts.update');


/**
 * Star in favorite list
 */
Route::post('/chat/star', 'MessagesController@favorite')->name('star');

/**
 * get favorites list
 */
Route::post('/chat/favorites', 'MessagesController@getFavorites')->name('favorites');

/**
 * Search in messenger
 */
Route::post('/chat/search', 'MessagesController@search')->name('search');

/**
 * Get shared photos
 */
Route::post('/chat/shared', 'MessagesController@sharedPhotos')->name('shared');

/**
 * Delete Conversation
 */
Route::post('/chat/deleteConversation', 'MessagesController@deleteConversation')->name('conversation.delete');

/**
 * Delete Conversation
 */
Route::post('/chat/updateSettings', 'MessagesController@updateSettings')->name('avatar.update');

/**
 * Set active status
 */
Route::post('/chat/setActiveStatus', 'MessagesController@setActiveStatus')->name('activeStatus.set');


/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
Route::get('/{id}', 'MessagesController@index')->name('user');