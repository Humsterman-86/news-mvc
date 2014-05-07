<?php

class Article 
{	
	public $id;
	public $title;
	public $content;
	public $date;

	public static function getBySql($sql) 
	{
		try
		{
			// Создаем соединение с БД
			$database = new Database();

			// Установим вывод ошибок
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// Выполнение запроса
			$statement = $database->query($sql);
			
			// Фетчим результаты запроса
			$statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
			$result = $statement->fetchAll();
			
			// Закрываем соединение с БД
			$database = null;
			
			// Возвращаем результаты запроса
			return $result;
		}
		catch (PDOException $exception) 
		{
			die($exception->getMessage());
		}		
	}
	
	public static function getAll() 
	{
		$sql = 'select * from news';
		return self::getBySql($sql);				
	}

	public static function getById($id) 
	{
		try
		{
			$database = new Database();
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "select * from news where id = :id limit 1";
			$statement = $database->prepare($sql);
			$statement->bindParam(':id', $id, PDO::PARAM_INT);			
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
			$result = $statement->fetch();
			$database = null;
			return $result;
		}	
		catch (PDOException $exception) 
		{
			die($exception->getMessage());
		}
	}
	
	private function insert() 
	{	
		try
		{
			$database = new Database();
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "insert into news (title, content) values (:title, :content)";
                        // Формируем запрос
                        $statement = $database->prepare($sql);
			$statement->bindParam(':title', $this->title, PDO::PARAM_STR);
			$statement->bindParam(':content', $this->content, PDO::PARAM_STR);
			$statement->execute();
			$count = $statement->rowCount();
			$database = null;
			return $count;
		}
		catch (PDOException $exception) 
		{
			die($exception->getMessage());
		}			
	}

	private function update() 
	{
		try
		{
			$database = new Database();
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "update news set title = :title, content = :content where id = :id";
			$statement = $database->prepare($sql);
			$statement->bindParam(':title', $this->title, PDO::PARAM_STR);
			$statement->bindParam(':content', $this->content, PDO::PARAM_STR);
			$statement->bindParam(':id', $this->id, PDO::PARAM_INT);
			$statement->execute();
			$count = $statement->rowCount();
			$database = null;
			return $count;
		}
		catch (PDOException $exception) 
		{
			die($exception->getMessage());
		}
	}

	public function delete() 
	{
		try
		{
			$database = new Database();
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "delete from news where id = :id limit 1";
			$statement = $database->prepare($sql);
			$statement->bindParam(':id', $this->id, PDO::PARAM_INT);
			$statement->execute();
			$count = $statement->rowCount();
			$database = null;
			return $count;
		}
                // Обработка ошибок
                catch (PDOException $exception) 
		{
			die($exception->getMessage());
		}
	}
	
	public function save() 
	{
		// Проверим, есть ли объект с id
		if (isset($this->id)) {	
		
			// Обновляем, если есть такая запись
			return $this->update();
			
		} else {
		
			// Создадим новую запись, если нет id
			return $this->insert();
		}
	}	
}