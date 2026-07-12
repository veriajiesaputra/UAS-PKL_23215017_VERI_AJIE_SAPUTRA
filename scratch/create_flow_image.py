import os
from PIL import Image, ImageDraw, ImageFont, ImageFilter

def create_shadowed_image(img, radius=15, border_width=1, border_color=(230, 230, 230)):
    # Add rounded corners and shadow to an image
    # Create mask for rounded corners
    mask = Image.new('L', img.size, 0)
    draw = ImageDraw.Draw(mask)
    draw.rounded_rectangle([(0, 0), img.size], radius=radius, fill=255)
    
    # Apply rounded corners to image
    rounded_img = Image.new('RGBA', img.size, (0, 0, 0, 0))
    rounded_img.paste(img, (0, 0), mask=mask)
    
    # Create border
    border_img = Image.new('RGBA', img.size, (0, 0, 0, 0))
    border_draw = ImageDraw.Draw(border_img)
    border_draw.rounded_rectangle([(0, 0), (img.size[0]-1, img.size[1]-1)], radius=radius, outline=border_color, width=border_width)
    rounded_img = Image.alpha_composite(rounded_img, border_img)
    
    # Create shadow
    shadow_size = (img.size[0] + 40, img.size[1] + 40)
    shadow = Image.new('RGBA', shadow_size, (0, 0, 0, 0))
    shadow_draw = ImageDraw.Draw(shadow)
    shadow_draw.rounded_rectangle([(20, 20), (shadow_size[0]-21, shadow_size[1]-21)], radius=radius, fill=(0, 0, 0, 25))
    shadow = shadow.filter(ImageFilter.GaussianBlur(12))
    
    # Paste image onto shadow
    shadow.paste(rounded_img, (20, 20), mask=rounded_img.split()[3])
    return shadow

def main():
    print("Starting crop and merge process...")
    # Paths
    img1_path = 'public/assets/images/landing/deteksi-screen.png'
    img2_path = 'C:/Users/ASUS/.gemini/antigravity-ide/brain/741dbc91-eaf3-432d-81ca-95c6874d7430/symptom_wizard_modal_scroll_1783616216836.png'
    img3_path = 'C:/Users/ASUS/.gemini/antigravity-ide/brain/741dbc91-eaf3-432d-81ca-95c6874d7430/hasil_diagnosa_thrips_bawang_1783618474801.png'
    output_path = 'public/assets/images/landing/deteksi-flow.png'
    
    # Load images
    img1 = Image.open(img1_path).convert('RGBA')
    img2 = Image.open(img2_path).convert('RGBA')
    img3 = Image.open(img3_path).convert('RGBA')
    
    # 1. Crop Image 1 (Target selection)
    # Viewport is 1925 x 965. Crop main cards block
    crop1 = img1.crop((100, 100, 1825, 900))
    crop1 = crop1.resize((450, 208), Image.Resampling.LANCZOS)
    
    # 2. Crop Image 2 (Symptom checking modal)
    # Viewport is 1899 x 965. Crop modal container (centered)
    crop2 = img2.crop((520, 40, 1379, 915))
    crop2 = crop2.resize((400, 407), Image.Resampling.LANCZOS)
    
    # 3. Crop Image 3 (Result page)
    # Viewport is 1899 x 2975. Crop result banner and selected symptoms
    crop3 = img3.crop((300, 300, 1600, 1900))
    crop3 = crop3.resize((400, 492), Image.Resampling.LANCZOS)
    
    # Process shadows
    s_crop1 = create_shadowed_image(crop1)
    s_crop2 = create_shadowed_image(crop2)
    s_crop3 = create_shadowed_image(crop3)
    
    # Create final canvas
    canvas_w, canvas_h = 1500, 900
    canvas = Image.new('RGB', (canvas_w, canvas_h), (250, 245, 247)) # Soft pink/grey background
    
    # Paste images
    # Positions are relative to shadow container size (image + 40px padding)
    canvas.paste(s_crop1, (20, 230), mask=s_crop1.split()[3])
    canvas.paste(s_crop2, (510, 180), mask=s_crop2.split()[3])
    canvas.paste(s_crop3, (1020, 130), mask=s_crop3.split()[3])
    
    # Draw text and arrows
    draw = ImageDraw.Draw(canvas)
    
    # Fonts
    font_path = "C:/Windows/Fonts/arialbd.ttf" # Bold
    font_path_reg = "C:/Windows/Fonts/arial.ttf" # Regular
    
    title_font = ImageFont.truetype(font_path, 22)
    step_font = ImageFont.truetype(font_path, 16)
    desc_font = ImageFont.truetype(font_path_reg, 13)
    arrow_font = ImageFont.truetype(font_path, 14)
    
    # Main Header
    draw.text((40, 40), "ALUR INFERENSI BACKWARD CHAINING PADA APLIKASI", fill=(92, 6, 50), font=title_font)
    draw.text((40, 75), "Proses pelacakan dari menentukan hipotesis, verifikasi gejala, hingga penentuan hasil kepastian (CF).", fill=(94, 64, 78), font=desc_font)
    
    # Step 1 Labels
    draw.text((40, 175), "LANGKAH 1: INISIASI HIPOTESIS", fill=(128, 8, 67), font=step_font)
    draw.text((40, 200), "Pengguna menentukan penyakit/hama yang dicurigai (goal)", fill=(120, 100, 110), font=desc_font)
    
    # Step 2 Labels
    draw.text((530, 125), "LANGKAH 2: VERIFIKASI GEJALA (PREMIS)", fill=(128, 8, 67), font=step_font)
    draw.text((530, 150), "Sistem menanyakan gejala wajib pendukung hipotesis", fill=(120, 100, 110), font=desc_font)
    
    # Step 3 Labels
    draw.text((1040, 75), "LANGKAH 3: EVALUASI & HASIL (CF)", fill=(22, 163, 74), font=step_font)
    draw.text((1040, 100), "Kombinasi Certainty Factor membuktikan hipotesis", fill=(120, 100, 110), font=desc_font)
    
    # Draw arrows
    # Arrow 1 to 2
    # Line
    draw.line([(495, 350), (525, 350)], fill=(128, 8, 67), width=3)
    # Head
    draw.polygon([(525, 345), (535, 350), (525, 355)], fill=(128, 8, 67))
    draw.text((485, 325), "Mundur", fill=(128, 8, 67), font=arrow_font)
    
    # Arrow 2 to 3
    # Line
    draw.line([(935, 350), (1035, 350)], fill=(22, 163, 74), width=3)
    # Head
    draw.polygon([(1035, 345), (1045, 350), (1035, 355)], fill=(22, 163, 74))
    draw.text((955, 325), "Kombinasi", fill=(22, 163, 74), font=arrow_font)
    
    # Save image
    canvas.save(output_path, "PNG")
    print(f"Flow image saved successfully at: {output_path}")

if __name__ == '__main__':
    main()
