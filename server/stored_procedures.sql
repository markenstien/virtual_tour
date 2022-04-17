DELIMITER $$

CREATE OR ALTER PROCEDURE setPoiImageDefault(
    IN poi_image_id INT(10)
)
BEGIN
	DECLARE p_poi_id INT DEFAULT 0;
    
    SELECT poi_id INTO p_poi_id  FROM poi_image_galleries
        WHERE id = poi_image_id;

    UPDATE poi_image_galleries
        SET is_default_bg = false 
            WHERE id != poi_image_id
                AND poi_id = p_poi_id;

    UPDATE poi_image_galleries
        SET is_default_bg = true 
            WHERE id = poi_image_id;
END$$

DELIMITER;
    


