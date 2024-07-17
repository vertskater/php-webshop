<?php

namespace Cm\Shop\Classes;

class Image {
	protected Database $db;
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function getHeaderImage(string $template_name): array {
		$sql = "SELECT i.filename, i.alt, t.template_name FROM images as i
            JOIN templates t on t.id = i.template
						WHERE t.template_name = :template_name AND i.type = :type";
		return $this->db->sql_execute($sql, [
			'template_name' => $template_name,
			'type' => 'header_img'
		])->fetchAll();
	}

	public function getProfilePicId(string $file_name, string $type = 'profile_img'): ?int{
		$sql = "SELECT id FROM images WHERE filename = :filename AND type = :type";
		return $this->db->sql_execute($sql, ['filename' => $file_name, 'type' => $type])->fetchColumn();
	}
	public function save(string $file_name, string $alt_text, string $type = 'profile_img'): string|false {
		$sql = "INSERT INTO images (filename, alt, type) VALUES (:filename, :alt, :type)";
		try {
			$this->db->sql_execute($sql, [
				'filename' => $file_name,
				'alt' => $alt_text,
				'type' => $type
			]);
			return $this->db->lastInsertId();
		}catch (\PDOException $e) {
			return false;
		}
	}
	public function deleteImage(int|string $image_id): bool {
		$sql = "DELETE FROM images WHERE id = :image_id";
		return (bool)$this->db->sql_execute($sql, ['image_id' => $image_id]);
	}
	public function getImageById(int|string $image_id): array {
		$sql = "SELECT filename, alt FROM images WHERE id = :image_id";
		return $this->db->sql_execute($sql, ['image_id' => $image_id])->fetch();
	}
}