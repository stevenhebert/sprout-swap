<?PHP
namespace Edu\Cnm\SproutSwap;
require_once ("autoload.php");

/**
 * Class PostImage weak entity
 * @see Post
 * @see Image
 * @package Edu\Cnm\SproutSwap
 */
class PostImage implements \JsonSerializable{
	/**
	 * foreign key
	 * @var int $postImageImageId
	 */
	private $postImageImageId;
	/**
	 * foreign key
	 * @var int $postImagePostId
	 */
	private $postImagePostId;
	/**
	 * PostImage constructor.
	 * @param int $newPostImageImageId
	 * @param int $newPostImagePostId
	 * @throws \Exception if some error occurs
	 * @throws \TypeError if data is in incorrect formats
	 * @throws \InvalidArgumentException if invalid data
	 * @throws \RangeException if data outside of bounds
	 */
	public function __construct(int $newPostImageImageId, int $newPostImagePostId) {
		try{
			$this->setPostImageImageId($newPostImageImageId);
			$this->setPostImagePostId($newPostImagePostId);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $rangeException) {
			throw (new \RangeException($rangeException->getMessage(), 0, $rangeException));
		} catch(\TypeError $typeError) {
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for PostImageImageId
	 * @return int
	 */
	public function getPostImageImageId(){
		return $this->postImageImageId;
	}
	/**
	 * mutator method for postImageImageId
	 * @param int $newPostImageImageId
	 * @throws \RangeException if postImageImageId is less than or equal to zero
	 */
	public function setPostImageImageId(int $newPostImageImageId) {
		if($newPostImageImageId <= 0){
			throw(new \RangeException("postImageImageId must be greater than zero"));
		}
		$this->postImageImageId = $newPostImageImageId;
	}

	/**
	 * accessor method for postImagePostId
	 * @return int
	 */
	public function getPostImagePostId(){
		return $this->postImagePostId;
	}
	/**
	 * @param int $newPostImagePostId
	 * @throws \RangeException if postImagePostId is less than or equal to zero
	 */
	public function setPostImagePostId(int $newPostImagePostId){
		if($newPostImagePostId <= 0){
			throw(new \RangeException("postImagePostId must be greater than zero"));
		}
		$this->postImagePostId = $newPostImagePostId;
	}
	/**
	 * insert method
	 * @param \PDO $pdo PHP data connection object
	 */
	public function insert(\PDO $pdo){
		if($this->postImageImageId === null || $this->postImagePostId === null){
			throw(new \PDOException("Ids cannot be null"));
		}
		//create query template
		$query = "INSERT INTO postImage(postImageImageId, postImagePostId) VALUES(:postImageImageId, :postImagePostId)";
		$statement = $pdo->prepare($query);
		//bind variables and execute
		$parameters = ["postImageImageId" => $this->postImageImageId, "postImagePostId" => $this->postImagePostId];
		$statement->execute($parameters);
	}
	/**
	 * Delete function for postImage table
	 * @param \PDO $pdo PHP data connection object
	 */
	public function delete(\PDO $pdo){
		if($this->postImageImageId === null || $this->postImagePostId === null){
			throw(new \PDOException("Ids cannot be null"));
		}
		//create query template
		$query = "DELETE FROM postImage WHERE postImageImageId = :postImageImageId AND postImagePostId = :postImagePostId";
		$statement = $pdo->prepare($query);
		//bind variables
		$parameters = ["postImageImageId" => $this->postImageImageId, "postImagePostId" => $this->postImagePostId];
		$statement->execute($parameters);
	}

	/**
	 * @param \PDO $pdo
	 * @param int $postImageImageId
	 * @return \SplFixedArray
	 * @throws \Exception
	 */
	public static function getPostImageByPostImageImageId(\PDO $pdo, int $postImageImageId){
		if($postImageImageId <= 0){
			throw(new \RangeException("postImagePostId must be greater than 0"));
		}
		//create query template
		$query = "SELECT postImageImageId, postImagePostId FROM postImage WHERE postImageImageId = :postImageImageId";
		$statement = $pdo->prepare($query);
		//bind variables and execute
		$parameters = ["postImageImageId" => $postImageImageId];
		$statement->execute($parameters);
		//grab postImage from mySQL
		$postImages = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$postImage = new postImage($row["postImageImageId"], $row["postImagePostId"]);
				$postImages[$postImages->key()] = $postImage;
				$postImages->next();
			} catch(\Exception $exception){
				throw(new \Exception($exception->getMessage(), 0, $exception));
			}
		}
		return $postImages;
	}

	/**
	 * @param \PDO $pdo
	 * @param int $postImagePostId
	 * @return \SplFixedArray
	 * @throws \Exception
	 */
	public static function getPostImageByPostImagePostId(\PDO $pdo, int $postImagePostId){
		if($postImagePostId <= 0){
			throw(new \RangeException("postImagePostId must be greater than 0"));
		}
		//create query template
		$query = "SELECT postImageImageId, postImagePostId FROM postImage WHERE postImagePostId = :postImagePostId";
		$statement = $pdo->prepare($query);
		//bind variables and execute
		$parameters = ["postImagePostId" => $postImagePostId];
		$statement->execute($parameters);
		//grab postImage from mySQL
		$postImages = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$postImage = new PostImage($row["postImageImageId"], $row["postImagePostId"]);
				$postImages[$postImages->key()] = $postImage;
				$postImages->next();
			} catch(\Exception $exception){
				throw(new \Exception($exception->getMessage(), 0, $exception));
			}
		}
		return $postImages;
	}
	/**
	 * @param \PDO $pdo
	 * @param int $postImageImageId
	 * @param int $postImagePostId
	 * @return PostImage|null
	 */
	public static function getPostImageByPostImageImageIdAndPostImagePostId(\PDO $pdo, int $postImageImageId, int $postImagePostId){
		if($postImageImageId <= 0){
			throw(new \RangeException("postImageImageId must be greater than 0"));
		} else if($postImagePostId <= 0){
			throw(new \RangeException("postImagePostId must be greater than 0"));
		}
		//create query template
		$query = "SELECT postImageImageId, postImagePostId FROM postImage WHERE postImageImageId = :postImageImageId AND postImagePostId = :postImagePostId";
		$statement = $pdo->prepare($query);
		//bind variables and execute
		$parameters = ["postImageImageId" => $postImageImageId, "postImagePostId" => $postImagePostId];
		$statement->execute($parameters);
		//grab postImage from mySQL
		try{
			$postImage = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$postImage = new PostImage ($row["postImageImageId"], $row["postImagePostId"]);
			}
		} catch(\Exception $exception){
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($postImage);
	}
	/**
	 * @param \PDO $pdo
	 * @param int $postImagePostId
	 * @return \SplFixedArray
	 * @throws \Exception
	 */
	public static function getPostImagesByPostImagePostId(\PDO $pdo, int $postImagePostId){
		if($postImagePostId <= 0){
			throw(new \RangeException("postImagePostId must be greater than 0"));
		}
		//prepare query statement
		$query = "SELECT postImageImageId, postImagePostId FROM postImage WHERE postImagePostId = :postImagePostId";
		$statement = $pdo->prepare($query);
		//bind variables
		$parameters = ["postImagePostId" => $postImagePostId];
		$statement->execute($parameters);
		//build array of images
		$postImages = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$postImage = new postImage($row["postImageImageId"], $row["postImagePostId"]);
				$postImages[$postImages->key()] = $postImage;
				$postImages->next();
			} catch(\Exception $exception){
				throw(new \Exception($exception->getMessage(), 0, $exception));
			}
		}
		return $postImages;
	}
	/**
	 * JSON Serializable method
	 * @return array of data to be serialized
	 */
	public function jsonSerialize(){
		$fields = get_object_vars($this);
		return($fields);
	}
}