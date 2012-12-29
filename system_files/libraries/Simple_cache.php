<?php

/*

    Simple Cache for CodeIgniter
    By Christopher CLarke <chris@cclarke.me>
	http://simple-cache.cclarke.me

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

class Simple_cache {
 
	/**
	 * @var int containing the number of seconds that a cached item will be considered current
	 */
	public $expire_after = 300;

    /**
     * @var String containing the directory to save the cached files in
     */
    public $cache_dir;
      
	/**
	 * Constructor
	 * 
	 * Used here to set the cache directory based on the version of CodeIgniter being used
	 */
	
	function __construct()
	{
		// check if the developer has not set a custom cache directory
		if (empty($this->cache_dir) == true)
		{
			// check CodeIgniter version
			if (version_compare(CI_VERSION, '2.0', 'ge') == true)
			{
				$this->cache_dir = APPPATH;
			} else {
				$this->cache_dir = BASEPATH;			
			}
		}
	}	

	/**
	 * Caches an item which can be retrieved by key
	 *	
	 * @param string $key identitifer to retrieve the data later
	 * @param mixed $value to be cached
	 */
	function cache_item($key, $value)
	{
		// hashing the key in order to ensure that the item is stored with an appropriate file name in the file system.	
		$key = sha1($key);

		// serialises the contents so that they can be stored in plain text
		$value = serialize($value);

		file_put_contents($this->cache_dir.'cache/'.$key.'.cache', $value);		

	}

	/**
	 * Checks whether an item is cached or not
	 * 
	 * @param string $key containing the identifier of the cached item
	 * @return bool whether the item is currently cached or not
	 */ 
	function is_cached($key)
	{
		$key = sha1($key);
		// checks if the cached item exists and that it has not expired. 
        
        $file_expires = file_exists($this->cache_dir.'cache/'.$key.'.cache') ? filemtime($this->cache_dir.'cache/'.$key.'.cache')+$this->expire_after : (time() - 10);
        
		if ($file_expires >= time())
		{			
			return true;
		} else {
			return false;			
		}		
	}

	/**
	 * Retrieves the cached item
	 *
	 * @param string $key containing the identifier of the item to retrieve
	 * @return mixed the cached item or items
	 */
	function get_item($key)
	{
		$key = sha1($key);
		$item = file_get_contents($this->cache_dir.'cache/'.$key.'.cache');
		$items = unserialize($item);

		return $items;
	}

	/**
	 * Deletes the cached item
	 * 
	 * @param string $key containing the identifier of the item to delete.
	*/
	function delete_item($key)
	{
		unlink($this->cache_dir.'cache/'.sha1($key).'.cache');
	}

}