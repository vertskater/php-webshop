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

}